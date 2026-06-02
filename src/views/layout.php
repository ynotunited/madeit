<?php
    $currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $currentScheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $currentHost = $_SERVER['HTTP_HOST'] ?? 'madeit.test';
    $currentUrl = $currentScheme . '://' . $currentHost . ($currentPath ?: '/');
    $isAdminPage = strpos($currentPath, '/admin') === 0;
    $defaultDescriptions = [
        '/' => 'MadeIT Codes builds and launches practical SaaS products that solve real business problems.',
        '/about' => 'Learn how MadeIT Codes designs and ships practical software products for businesses and teams.',
        '/products' => 'Explore the MadeIT product ecosystem, including live and upcoming software products.',
        '/projects' => 'Explore the MadeIT product ecosystem, including live and upcoming software products.',
        '/flow' => 'Use Idea Flow to simulate software ideas and estimate cost, timeline, and modules.',
        '/contact' => 'Contact MadeIT Codes to discuss a software product, partnership, or new idea.',
        '/admin' => 'Admin dashboard for MadeIT Codes product, lead, and simulation management.',
    ];
    $metaDescription = $metaDescription ?? ($defaultDescriptions[$currentPath] ?? 'MadeIT Codes builds practical SaaS products.');
    require_once __DIR__ . '/header.php';
?>

<main class="container fade-in-up <?= !empty($isHomePage) ? 'home-page' : 'page-content' ?> <?= (($currentPath ?? '') === '/contact') ? 'page-content--contact' : '' ?>">
    <?php if (empty($isHomePage)): ?>
        <?php
            $visibleTitle = trim(str_replace(' | MadeIT Codes', '', $pageTitle ?? ''));
            if ($visibleTitle === '') {
                $visibleTitle = 'MadeIT Codes';
            }
        ?>
        <section class="page-title-block">
            <h1><?= htmlspecialchars($visibleTitle) ?></h1>
        </section>
    <?php endif; ?>
    <?php if (!empty($_SESSION['madeit_flash'])): ?>
        <?php $flash = $_SESSION['madeit_flash']; unset($_SESSION['madeit_flash']); ?>
        <div style="margin: 1rem 0; padding: 0.875rem 1rem; border-radius: var(--radius-md); background: <?= $flash['type'] === 'success' ? 'rgba(34, 197, 94, 0.12)' : 'rgba(239, 68, 68, 0.12)' ?>; color: <?= $flash['type'] === 'success' ? '#15803d' : '#b91c1c' ?>; font-weight: 600;">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['contact_flash'])): ?>
        <?php $contactFlash = $_SESSION['contact_flash']; unset($_SESSION['contact_flash']); ?>
        <div style="margin: 1rem 0; padding: 0.875rem 1rem; border-radius: var(--radius-md); background: <?= $contactFlash['type'] === 'success' ? 'rgba(34, 197, 94, 0.12)' : 'rgba(239, 68, 68, 0.12)' ?>; color: <?= $contactFlash['type'] === 'success' ? '#15803d' : '#b91c1c' ?>; font-weight: 600;">
            <?= htmlspecialchars($contactFlash['message']) ?>
        </div>
    <?php endif; ?>
    <?php require_once $viewFile; ?>
</main>

<?php
require_once __DIR__ . '/footer.php';
?>
