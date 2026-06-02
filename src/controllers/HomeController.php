<?php
require_once __DIR__ . '/../models/Product.php';

class HomeController {
    public function index() {
        $products = Product::getAllActive();
        $pageTitle = 'MadeIT Codes | SaaS Ecosystem Hub';
        $isHomePage = true;
        $viewFile = __DIR__ . '/../views/home.php';
        require_once __DIR__ . '/../views/layout.php';
    }
}
