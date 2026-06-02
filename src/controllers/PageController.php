<?php

class PageController {
    public function about() {
        $pageTitle = 'About | MadeIT Codes';
        $metaDescription = 'Learn how MadeIT Codes designs and ships practical software products for businesses and teams.';
        $viewFile = __DIR__ . '/../views/about.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function contact() {
        $pageTitle = 'Contact | MadeIT Codes';
        $metaDescription = 'Contact MadeIT Codes to discuss a software product, partnership, or new idea.';
        $viewFile = __DIR__ . '/../views/contact.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function projects() {
        $pageTitle = 'Products | MadeIT Codes';
        $metaDescription = 'Explore the MadeIT product ecosystem, including BuildLedger and upcoming products like ChatChow, Wazup Assist, and Landee.';
        $viewFile = __DIR__ . '/../views/projects.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function privacy() {
        $pageTitle = 'Privacy Policy | MadeIT Codes';
        $metaDescription = 'Read the MadeIT Codes Privacy Policy and how we handle user data, analytics, and product submissions.';
        $viewFile = __DIR__ . '/../views/privacy.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function terms() {
        $pageTitle = 'Terms of Use | MadeIT Codes';
        $metaDescription = 'Review the MadeIT Codes terms that govern access to the site, products, and admin features.';
        $viewFile = __DIR__ . '/../views/terms.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function compliance() {
        $pageTitle = 'Data & Compliance | MadeIT Codes';
        $metaDescription = 'See how MadeIT Codes approaches data handling, privacy, retention, and compliance across the product ecosystem.';
        $viewFile = __DIR__ . '/../views/compliance.php';
        require_once __DIR__ . '/../views/layout.php';
    }

    public function ip() {
        $pageTitle = 'IP Infringement | MadeIT Codes';
        $metaDescription = 'Learn how to report intellectual property concerns to MadeIT Codes and what happens after a report is submitted.';
        $viewFile = __DIR__ . '/../views/ip.php';
        require_once __DIR__ . '/../views/layout.php';
    }
}
