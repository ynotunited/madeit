<?php
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    public function show($slug) {
        $product = Product::getBySlug($slug);
        
        if (!$product) {
            http_response_code(404);
            echo "404 - Product Not Found";
            return;
        }

        $pageTitle = htmlspecialchars($product['name']) . ' | MadeIT Codes';
        $viewFile = __DIR__ . '/../views/product.php';
        require_once __DIR__ . '/../views/layout.php';
    }
}
