<?php
require_once __DIR__ . '/bootstrap.php';
madeit_load_env_file(__DIR__ . '/../.env');
require_once __DIR__ . '/controllers/HomeController.php';

class Router {
    private function requireAdminConfig() {
        return (madeit_env('MADEIT_ADMIN_USER') !== '' && madeit_env('MADEIT_ADMIN_PASSWORD') !== '');
    }

    private function isAdminRoute($path) {
        return strpos($path, '/admin') === 0;
    }

    private function ensureAdminAuth($path) {
        require_once __DIR__ . '/controllers/AdminController.php';
        $publicRoutes = ['/admin/login'];

        if (in_array($path, $publicRoutes, true)) {
            return true;
        }

        if (!$this->requireAdminConfig()) {
            http_response_code(403);
            echo 'Admin access is disabled until MADEIT_ADMIN_USER and MADEIT_ADMIN_PASSWORD are configured.';
            return false;
        }

        if (empty($_SESSION['madeit_admin_user']) || !is_array($_SESSION['madeit_admin_user'])) {
            header('Location: /admin/login');
            return false;
        }

        return true;
    }

    public function dispatch($uri, $method) {
        $path = parse_url($uri, PHP_URL_PATH);
        $path = rtrim($path, '/');
        
        if ($path === '' || $path === '/') {
            $controller = new HomeController();
            $controller->index();
            return;
        }
        
        if ($path === '/flow') {
            require_once __DIR__ . '/controllers/FlowController.php';
            $controller = new FlowController();
            $controller->index();
            return;
        }
        
        if ($path === '/api/flow/simulate' && $method === 'POST') {
            require_once __DIR__ . '/controllers/FlowController.php';
            $controller = new FlowController();
            $controller->simulate();
            return;
        }

        if (strpos($path, '/product/') === 0) {
            $slug = substr($path, strlen('/product/'));
            require_once __DIR__ . '/controllers/ProductController.php';
            $controller = new ProductController();
            $controller->show($slug);
            return;
        }
        
        if ($path === '/about') {
            require_once __DIR__ . '/controllers/PageController.php';
            (new PageController())->about();
            return;
        }

        if ($path === '/contact') {
            require_once __DIR__ . '/controllers/PageController.php';
            (new PageController())->contact();
            return;
        }

        if ($path === '/products' || $path === '/projects') {
            require_once __DIR__ . '/controllers/PageController.php';
            (new PageController())->projects();
            return;
        }

        if ($path === '/privacy') {
            require_once __DIR__ . '/controllers/PageController.php';
            (new PageController())->privacy();
            return;
        }

        if ($path === '/terms') {
            require_once __DIR__ . '/controllers/PageController.php';
            (new PageController())->terms();
            return;
        }

        if ($path === '/compliance') {
            require_once __DIR__ . '/controllers/PageController.php';
            (new PageController())->compliance();
            return;
        }

        if ($path === '/ip') {
            require_once __DIR__ . '/controllers/PageController.php';
            (new PageController())->ip();
            return;
        }

        if ($path === '/api/analytics/track' && $method === 'POST') {
            require_once __DIR__ . '/controllers/AnalyticsController.php';
            (new AnalyticsController())->track();
            return;
        }

        if ($path === '/api/contact' && $method === 'POST') {
            require_once __DIR__ . '/controllers/ContactController.php';
            (new ContactController())->submit();
            return;
        }

        if ($path === '/api/newsletter' && $method === 'POST') {
            require_once __DIR__ . '/controllers/NewsletterController.php';
            (new NewsletterController())->subscribe();
            return;
        }
        
        if ($this->isAdminRoute($path)) {
            require_once __DIR__ . '/controllers/AdminController.php';
            $admin = new AdminController();

            if ($path === '/admin/login') {
                $admin->login();
                return;
            }
            if ($path === '/admin/logout') {
                $admin->logout();
                return;
            }

            if (!$this->ensureAdminAuth($path)) {
                return;
            }
            if ($path === '/admin') {
                $admin->dashboard();
            } elseif ($path === '/admin/products') {
                $admin->products();
            } elseif ($path === '/admin/products/new') {
                $admin->productForm();
            } elseif ($path === '/admin/products/edit') {
                $admin->productForm($_GET['id'] ?? null);
            } elseif ($path === '/admin/products/save' && $method === 'POST') {
                $admin->saveProduct();
            } elseif ($path === '/admin/products/delete' && $method === 'POST') {
                $admin->deleteProduct($_POST['id'] ?? 0);
            } elseif ($path === '/admin/simulations') {
                $admin->simulations();
            } elseif ($path === '/admin/simulations/edit') {
                $admin->editRule($_GET['id'] ?? 0);
            } elseif ($path === '/admin/simulations/save' && $method === 'POST') {
                $admin->saveRule();
            } elseif ($path === '/admin/simulations/delete' && $method === 'POST') {
                $admin->deleteRule($_POST['id'] ?? 0);
            } elseif ($path === '/admin/leads') {
                $admin->leads();
            } elseif ($path === '/admin/leads/view') {
                $admin->viewLead($_GET['id'] ?? 0);
            } elseif ($path === '/admin/leads/delete' && $method === 'POST') {
                $admin->deleteLead($_POST['id'] ?? 0);
            } else {
                echo "404 Admin Route Not Found";
            }
            return;
        }
        
        echo "404 Not Found";
    }
}
