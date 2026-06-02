<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'madeIT | SaaS Ecosystem' ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'MadeIT Codes builds practical SaaS products.') ?>">
    <link rel="canonical" href="<?= htmlspecialchars($currentUrl ?? '/') ?>">
    <meta name="robots" content="<?= !empty($isAdminPage) ? 'noindex, nofollow' : 'index, follow' ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle ?? 'madeIT | SaaS Ecosystem') ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription ?? 'MadeIT Codes builds practical SaaS products.') ?>">
    <meta property="og:url" content="<?= htmlspecialchars($currentUrl ?? '/') ?>">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle ?? 'madeIT | SaaS Ecosystem') ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription ?? 'MadeIT Codes builds practical SaaS products.') ?>">
    <link rel="stylesheet" href="/css/global.css">
    <link rel="icon" type="image/png" href="/favicon.png">
    <?php if (empty($isAdminPage)): ?>
        <script type="application/ld+json">
        <?= json_encode([
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    '@id' => rtrim($currentUrl ?? '/', '/') . '#organization',
                    'name' => 'MadeIT Codes',
                    'url' => rtrim($currentUrl ?? '/', '/') . '/',
                    'logo' => rtrim($currentUrl ?? '/', '/') . '/images/logo_blue.png',
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => rtrim($currentUrl ?? '/', '/') . '#website',
                    'url' => rtrim($currentUrl ?? '/', '/') . '/',
                    'name' => 'MadeIT Codes',
                    'description' => $metaDescription ?? 'MadeIT Codes builds practical SaaS products.',
                ],
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
        </script>
    <?php endif; ?>
</head>
<body>
<?php
    $isAdminRequest = strpos($currentPath ?? '', '/admin') === 0;
    $isAdminAuthed = !empty($_SESSION['madeit_admin_user']) && is_array($_SESSION['madeit_admin_user']);
?>

<?php if ($isAdminRequest && $isAdminAuthed && ($currentPath ?? '') !== '/admin/login'): ?>
    <header class="site-navbar admin-navbar">
        <a href="/admin" class="hero-logo">
            <img src="/images/logo_blue.png" alt="madeIT" class="hero-logo-image">
        </a>

        <nav class="admin-nav-pill liquid-glass" aria-label="Admin navigation">
            <a href="/admin" class="hero-nav-link <?= (($currentPath ?? '') === '/admin' ? 'active' : '') ?>">Dashboard</a>
            <a href="/admin/products" class="hero-nav-link <?= (strpos($currentPath ?? '', '/admin/products') === 0 ? 'active' : '') ?>">Products</a>
            <a href="/admin/simulations" class="hero-nav-link <?= (strpos($currentPath ?? '', '/admin/simulations') === 0 ? 'active' : '') ?>">Rules</a>
            <a href="/admin/leads" class="hero-nav-link <?= (strpos($currentPath ?? '', '/admin/leads') === 0 ? 'active' : '') ?>">Leads</a>
            <a href="/admin/logout" class="hero-nav-link hero-nav-link--logout">Logout</a>
        </nav>
    </header>
<?php elseif (!empty($isHomePage)): ?>
    <div class="hero-shell">
        <video class="hero-video" autoplay muted loop playsinline preload="auto" aria-hidden="true">
            <source src="/videos/footer.mp4" type="video/mp4">
        </video>
        <div class="hero-overlay" aria-hidden="true"></div>

        <nav class="hero-navbar">
            <a href="/" class="hero-logo">
                <img src="/images/logo_white.png" alt="madeIT" class="hero-logo-image">
            </a>

            <div class="hero-nav-pill liquid-glass" aria-label="Primary navigation">
                <a href="/" class="hero-nav-link active">Home</a>
                <a href="/about" class="hero-nav-link">About</a>
                <a href="/products" class="hero-nav-link">Products</a>
                <a href="/flow" class="hero-nav-link">Idea Flow</a>
                <a href="/contact" class="hero-nav-link">Contact</a>
            </div>
        </nav>

        <main class="hero-content">
            <div class="hero-content-inner">
                <h1>We build and launch software products that solve real business problems</h1>
                <p>
                    MadeIT Codes is a platform that hosts and manages multiple SaaS products under one ecosystem.
                </p>

                <div class="hero-actions">
                    <a href="#products" class="btn btn-primary" style="font-size: 1rem; padding: 14px 22px;">Explore Products</a>
                    <a href="/flow" class="liquid-glass btn" style="color:#fff; text-decoration:none; font-size:1rem; padding:14px 22px;">Start Idea Simulation</a>
                </div>
            </div>
        </main>
    </div>
<?php else: ?>
    <header class="site-navbar">
        <a href="/" class="hero-logo">
            <img src="/images/logo_blue.png" alt="madeIT" class="hero-logo-image">
        </a>

        <nav class="site-nav-pill liquid-glass" aria-label="Primary navigation">
            <a href="/" class="hero-nav-link <?= (($currentPath ?? '/') === '/' ? 'active' : '') ?>">Home</a>
            <a href="/about" class="hero-nav-link <?= (($currentPath ?? '') === '/about' ? 'active' : '') ?>">About</a>
            <a href="/products" class="hero-nav-link <?= (in_array(($currentPath ?? ''), ['/products', '/projects'], true) ? 'active' : '') ?>">Products</a>
            <a href="/flow" class="hero-nav-link <?= (($currentPath ?? '') === '/flow' ? 'active' : '') ?>">Idea Flow</a>
            <a href="/contact" class="hero-nav-link <?= (($currentPath ?? '') === '/contact' ? 'active' : '') ?>">Contact</a>
        </nav>
    </header>
<?php endif; ?>
