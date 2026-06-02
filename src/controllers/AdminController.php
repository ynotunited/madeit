<?php
require_once __DIR__ . '/../bootstrap.php';
madeit_load_env_file(__DIR__ . '/../../.env');
require_once __DIR__ . '/../Database.php';

class AdminController {
    private function requireAuth() {
        if (!empty($_SESSION['madeit_admin_user']) && is_array($_SESSION['madeit_admin_user'])) {
            return true;
        }

        header('Location: /admin/login');
        exit;
    }

    private function render($pageTitle, $viewFile) {
        require_once __DIR__ . '/../views/layout.php';
    }

    private function flash($type, $message) {
        $_SESSION['madeit_flash'] = ['type' => $type, 'message' => $message];
    }

    private function redirect($path) {
        header('Location: ' . $path);
        exit;
    }

    public function login() {
        if (!empty($_SESSION['madeit_admin_user']) && is_array($_SESSION['madeit_admin_user'])) {
            $this->redirect('/admin');
        }

        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = trim($_POST['username'] ?? '');
            $pass = (string) ($_POST['password'] ?? '');
            $expectedUser = (string) madeit_env('MADEIT_ADMIN_USER');
            $expectedPass = (string) madeit_env('MADEIT_ADMIN_PASSWORD');

            if ($expectedUser === '' || $expectedPass === '') {
                $error = 'Admin credentials are not configured on this server.';
            } elseif (hash_equals($expectedUser, $user) && hash_equals($expectedPass, $pass)) {
                session_regenerate_id(true);
                $_SESSION['madeit_admin_user'] = [
                    'username' => $user,
                    'authenticated_at' => date('c'),
                    'last_activity_at' => date('c'),
                ];
                $this->redirect('/admin');
            } else {
                $error = 'Invalid username or password.';
            }
        }

        $pageTitle = 'Admin Login | MadeIT Codes';
        $viewFile = __DIR__ . '/../views/admin/login.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function logout() {
        unset($_SESSION['madeit_admin_user']);
        $this->redirect('/admin/login');
    }

    public function dashboard() {
        $this->requireAuth();
        $pageTitle = 'Admin Dashboard | MadeIT Codes';
        $viewFile = __DIR__ . '/../views/admin/dashboard.php';
        $this->render($pageTitle, $viewFile);
    }

    public function products() {
        $this->requireAuth();
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM products ORDER BY id DESC");
        $products = $stmt->fetchAll();
        $pageTitle = 'Products Manager | Admin';
        $viewFile = __DIR__ . '/../views/admin/products.php';
        $this->render($pageTitle, $viewFile);
    }

    public function productForm($id = null) {
        $this->requireAuth();
        $errors = [];
        $product = [
            'id' => null,
            'name' => '',
            'slug' => '',
            'description' => '',
            'long_description' => '',
            'cta_label' => 'Launch Product',
            'url' => '',
            'status' => 'building',
            'category' => '',
        ];

        if ($id !== null) {
            $stmt = Database::getConnection()->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([(int) $id]);
            $found = $stmt->fetch();
            if ($found) {
                $product = $found;
            }
        }

        $pageTitle = ($id ? 'Edit Product' : 'Add Product') . ' | Admin';
        $viewFile = __DIR__ . '/../views/admin/product-form.php';
        $this->render($pageTitle, $viewFile);
    }

    public function saveProduct() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/products');
        }

        $id = trim($_POST['id'] ?? '');
        $name = trim($_POST['name'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $longDescription = trim($_POST['long_description'] ?? '');
        $ctaLabel = trim($_POST['cta_label'] ?? 'Launch Product');
        $url = trim($_POST['url'] ?? '');
        $status = trim($_POST['status'] ?? 'building');
        $category = trim($_POST['category'] ?? '');
        $errors = [];
        $product = [
            'id' => $id !== '' ? (int) $id : null,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'long_description' => $longDescription,
            'cta_label' => $ctaLabel,
            'url' => $url,
            'status' => $status,
            'category' => $category,
        ];

        if ($name === '') {
            $errors['name'] = 'Name is required.';
        }
        if ($slug === '') {
            $errors['slug'] = 'Slug is required.';
        } elseif (!preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            $errors['slug'] = 'Use lowercase letters, numbers, and hyphens only.';
        }
        if ($url !== '' && !filter_var($url, FILTER_VALIDATE_URL)) {
            $errors['url'] = 'Please enter a valid URL.';
        }

        if (!empty($errors)) {
            $pageTitle = ($id !== '' ? 'Edit Product' : 'Add Product') . ' | Admin';
            $viewFile = __DIR__ . '/../views/admin/product-form.php';
            require_once __DIR__ . '/../views/layout.php';
            return;
        }

        $allowedStatuses = ['live', 'beta', 'building', 'disabled'];
        if (!in_array($status, $allowedStatuses, true)) {
            $status = 'building';
        }

        $db = Database::getConnection();
        if ($id !== '') {
            $stmt = $db->prepare("UPDATE products SET name=?, slug=?, description=?, long_description=?, cta_label=?, url=?, status=?, category=? WHERE id=?");
            $stmt->execute([$name, $slug, $description, $longDescription, $ctaLabel, $url, $status, $category, (int) $id]);
            $this->flash('success', 'Product updated.');
            if (($_POST['save_mode'] ?? '') === 'continue') {
                $this->redirect('/admin/products/edit?id=' . (int) $id);
            }
        } else {
            $stmt = $db->prepare("INSERT INTO products (name, slug, description, long_description, cta_label, url, status, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $slug, $description, $longDescription, $ctaLabel, $url, $status, $category]);
            $newId = (int) $db->lastInsertId();
            $this->flash('success', 'Product created.');
            if (($_POST['save_mode'] ?? '') === 'continue') {
                $this->redirect('/admin/products/edit?id=' . $newId);
            }
        }

        $this->redirect('/admin/products');
    }

    public function deleteProduct($id) {
        $this->requireAuth();
        $stmt = Database::getConnection()->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([(int) $id]);
        $this->flash('success', 'Product deleted.');
        $this->redirect('/admin/products');
    }

    public function simulations() {
        $this->requireAuth();
        $db = Database::getConnection();
        $rules = $db->query("SELECT * FROM product_rules ORDER BY id DESC")->fetchAll();
        $ruleToEdit = null;
        if (!empty($_GET['edit_id'])) {
            $stmt = $db->prepare("SELECT * FROM product_rules WHERE id = ?");
            $stmt->execute([(int) $_GET['edit_id']]);
            $ruleToEdit = $stmt->fetch() ?: null;
        }
        $pageTitle = 'Simulation Config | Admin';
        $viewFile = __DIR__ . '/../views/admin/simulations.php';
        $this->render($pageTitle, $viewFile);
    }

    public function editRule($id) {
        $this->requireAuth();
        $this->redirect('/admin/simulations?edit_id=' . (int) $id);
    }

    public function saveRule() {
        $this->requireAuth();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/simulations');
        }

        $id = trim($_POST['id'] ?? '');
        $keyword = trim($_POST['keyword'] ?? '');
        $module = trim($_POST['module'] ?? '');
        $cost = (int) ($_POST['cost_weight'] ?? 0);
        $complexity = max(1, (int) ($_POST['complexity_weight'] ?? 1));
        $errors = [];
        $ruleToEdit = [
            'id' => $id !== '' ? (int) $id : null,
            'keyword' => $keyword,
            'module' => $module,
            'cost_weight' => $cost,
            'complexity_weight' => $complexity,
        ];

        if ($keyword === '') {
            $errors['keyword'] = 'Keyword is required.';
        }
        if ($module === '') {
            $errors['module'] = 'Module is required.';
        }
        if ($cost < 0) {
            $errors['cost_weight'] = 'Cost cannot be negative.';
        }
        if ($complexity < 1) {
            $errors['complexity_weight'] = 'Timeline must be at least 1 day.';
        }

        if (!empty($errors)) {
            $db = Database::getConnection();
            $rules = $db->query("SELECT * FROM product_rules ORDER BY id DESC")->fetchAll();
            $pageTitle = 'Simulation Config | Admin';
            $viewFile = __DIR__ . '/../views/admin/simulations.php';
            require_once __DIR__ . '/../views/layout.php';
            return;
        }

        $db = Database::getConnection();
        if ($id !== '') {
            $stmt = $db->prepare("UPDATE product_rules SET keyword=?, module=?, cost_weight=?, complexity_weight=? WHERE id=?");
            $stmt->execute([$keyword, $module, $cost, $complexity, (int) $id]);
            $this->flash('success', 'Rule updated.');
            if (($_POST['save_mode'] ?? '') === 'continue') {
                $this->redirect('/admin/simulations?edit_id=' . (int) $id);
            }
        } else {
            $stmt = $db->prepare("INSERT INTO product_rules (keyword, module, cost_weight, complexity_weight) VALUES (?, ?, ?, ?)");
            $stmt->execute([$keyword, $module, $cost, $complexity]);
            $newId = (int) $db->lastInsertId();
            $this->flash('success', 'Rule created.');
            if (($_POST['save_mode'] ?? '') === 'continue') {
                $this->redirect('/admin/simulations?edit_id=' . $newId);
            }
        }

        $this->redirect('/admin/simulations');
    }

    public function deleteRule($id) {
        $this->requireAuth();
        $stmt = Database::getConnection()->prepare("DELETE FROM product_rules WHERE id = ?");
        $stmt->execute([(int) $id]);
        $this->flash('success', 'Rule deleted.');
        $this->redirect('/admin/simulations');
    }

    public function leads() {
        $this->requireAuth();
        $db = Database::getConnection();
        $leads = $db->query("SELECT * FROM leads ORDER BY id DESC")->fetchAll();
        $pageTitle = 'Leads & Analytics | Admin';
        $viewFile = __DIR__ . '/../views/admin/leads.php';
        $this->render($pageTitle, $viewFile);
    }

    public function viewLead($id) {
        $this->requireAuth();
        $this->redirect('/admin/leads?lead_id=' . (int) $id);
    }

    public function deleteLead($id) {
        $this->requireAuth();
        $stmt = Database::getConnection()->prepare("DELETE FROM leads WHERE id = ?");
        $stmt->execute([(int) $id]);
        $this->flash('success', 'Lead deleted.');
        $this->redirect('/admin/leads');
    }
}
