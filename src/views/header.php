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
    <?php $searchConsoleVerification = madeit_env('MADEIT_GOOGLE_SITE_VERIFICATION', ''); ?>
    <?php if (!empty($searchConsoleVerification) && empty($isAdminPage)): ?>
        <meta name="google-site-verification" content="<?= htmlspecialchars($searchConsoleVerification) ?>">
    <?php endif; ?>
    <link rel="stylesheet" href="/css/global.css">
    <link rel="icon" type="image/png" href="/favicon.png">
    <?php if (empty($isAdminPage)): ?>
        <?php $ga4Id = madeit_env('MADEIT_GA4_ID', ''); ?>
        <?php if (!empty($ga4Id)): ?>
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($ga4Id) ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '<?= htmlspecialchars($ga4Id) ?>', {
                    anonymize_ip: true,
                    send_page_view: true
                });
            </script>
        <?php endif; ?>
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
    <?php if (!empty($isHomePage)): ?>
        <style>
            @media (max-width: 767px) {
                .hero-navbar {
                    padding: 14px 16px;
                    align-items: center;
                }

                .hero-nav-pill {
                    display: none !important;
                }

                .hero-mobile-toggle {
                    display: inline-flex;
                    margin-left: auto;
                    z-index: 31;
                    align-items: center;
                    justify-content: center;
                    width: 42px;
                    height: 42px;
                    border-radius: 12px;
                    color: #fff;
                    background: transparent;
                    border: 0;
                    padding: 0;
                    cursor: pointer;
                    box-shadow: none;
                }

                .hero-mobile-menu {
                    position: absolute;
                    top: 72px;
                    left: 16px;
                    right: 16px;
                    z-index: 30;
                    border-radius: 20px;
                    padding: 16px;
                    display: grid;
                    gap: 8px;
                }

                .hero-mobile-menu[hidden] {
                    display: none !important;
                }

                .hero-mobile-menu .hero-nav-link {
                    display: flex;
                    align-items: center;
                    justify-content: flex-start;
                    width: 100%;
                    padding: 14px 16px;
                    border-radius: 14px;
                    color: rgba(255, 255, 255, 0.86);
                    text-decoration: none;
                    font-size: 0.95rem;
                    background: rgba(255, 255, 255, 0.06);
                }

                .hero-mobile-menu .hero-nav-link.active {
                    background: rgba(255, 255, 255, 0.16);
                    color: #fff;
                }

                .hero-mobile-icon {
                    position: relative;
                    width: 18px;
                    height: 18px;
                    display: block;
                }

                .hero-mobile-icon span {
                    position: absolute;
                    left: 0;
                    width: 100%;
                    height: 2px;
                    border-radius: 999px;
                    background: currentColor;
                    transition: transform 0.2s ease, opacity 0.2s ease, top 0.2s ease, bottom 0.2s ease;
                }

                .hero-mobile-icon--menu span:nth-child(1) { top: 2px; }
                .hero-mobile-icon--menu span:nth-child(2) { top: 8px; }
                .hero-mobile-icon--menu span:nth-child(3) { bottom: 2px; }

                .hero-mobile-icon--close {
                    display: none;
                }

                .hero-mobile-icon--close span:nth-child(1) {
                    top: 8px;
                    transform: rotate(45deg);
                }

                .hero-mobile-icon--close span:nth-child(2) {
                    top: 8px;
                    transform: rotate(-45deg);
                }
            }

            @media (min-width: 768px) {
                .hero-mobile-toggle { display: none !important; }
                .hero-mobile-menu { display: none !important; }
            }
        </style>
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

            <button type="button" class="hero-mobile-toggle liquid-glass" aria-label="Open navigation menu" aria-expanded="false" aria-controls="heroMobileMenu">
                <span class="hero-mobile-icon hero-mobile-icon--menu" aria-hidden="true">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
                <span class="hero-mobile-icon hero-mobile-icon--close" aria-hidden="true">
                    <span></span>
                    <span></span>
                </span>
            </button>
        </nav>

        <div class="hero-mobile-menu liquid-glass" id="heroMobileMenu" hidden>
            <a href="/" class="hero-nav-link active">Home</a>
            <a href="/about" class="hero-nav-link">About</a>
            <a href="/products" class="hero-nav-link">Products</a>
            <a href="/flow" class="hero-nav-link">Idea Flow</a>
            <a href="/contact" class="hero-nav-link">Contact</a>
        </div>

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
    <script>
        (function() {
            const toggle = document.querySelector('.hero-mobile-toggle');
            const menu = document.getElementById('heroMobileMenu');
            if (!toggle || !menu) return;

            const menuIcon = toggle.querySelector('.hero-mobile-icon--menu');
            const closeIcon = toggle.querySelector('.hero-mobile-icon--close');

            function setOpen(isOpen) {
                toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                menu.hidden = !isOpen;
                if (menuIcon) {
                    menuIcon.style.display = isOpen ? 'none' : 'block';
                }
                if (closeIcon) {
                    closeIcon.style.display = isOpen ? 'block' : 'none';
                }
            }

            toggle.addEventListener('click', function() {
                const isOpen = toggle.getAttribute('aria-expanded') === 'true';
                setOpen(!isOpen);
            });

            menu.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    setOpen(false);
                });
            });

            document.addEventListener('click', function(event) {
                if (menu.hidden) return;
                if (menu.contains(event.target) || toggle.contains(event.target)) return;
                setOpen(false);
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setOpen(false);
                }
            });

            setOpen(false);
        })();
    </script>
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