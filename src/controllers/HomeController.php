<?php
require_once __DIR__ . '/../models/Product.php';

class HomeController {
    public function index() {
        $products = Product::getAllActive();
        if (empty($products)) {
            $products = [
                [
                    'name' => 'BuildLedger',
                    'slug' => 'buildledger',
                    'description' => 'BuildLedger keeps your pipeline connected so proposals, contracts, invoices, projects, and payments stop living in different tools.',
                    'long_description' => 'Run client work, documents, and revenue from one operating system.',
                    'cta_label' => 'Request Invite',
                    'url' => 'https://buildledger.madeitcodes.online/',
                    'status' => 'live',
                    'category' => 'Business OS',
                ],
                [
                    'name' => 'ChatChow',
                    'slug' => 'chatchow',
                    'description' => 'ChatChow is an AI-powered multi-channel restaurant ordering platform. It lets customers order through WhatsApp, Telegram, QR codes, a website chat widget, and voice while AI handles natural language, remembers preferences, and suggests upsells.',
                    'long_description' => 'A conversational commerce tool that helps restaurants take orders through the channels customers already use.',
                    'cta_label' => 'Coming Soon',
                    'url' => '',
                    'status' => 'coming soon',
                    'category' => 'Food Tech',
                ],
                [
                    'name' => 'Wazup Assist',
                    'slug' => 'wazup-assist',
                    'description' => 'WazUp Assist is an AI-powered WhatsApp receptionist for businesses. It automatically replies to customer messages using your own knowledge base, captures leads from conversations, and hands off to a human agent when needed.',
                    'long_description' => '24/7 WhatsApp receptionist for FAQs, pricing, policies, lead capture, and human handoff.',
                    'cta_label' => 'Coming Soon',
                    'url' => '',
                    'status' => 'coming soon',
                    'category' => 'Customer Support',
                ],
                [
                    'name' => 'Landee',
                    'slug' => 'landee',
                    'description' => 'Landee is an internal back-office operations system for real estate developers in Nigeria. It manages estates, deals, payments, allocation, and documents from one audit-friendly workflow.',
                    'long_description' => 'Digitise land inventory, track deal commitments, collect payments, approve allocations, and generate sale documents without relying on spreadsheets.',
                    'cta_label' => 'Coming Soon',
                    'url' => '',
                    'status' => 'coming soon',
                    'category' => 'Real Estate Ops',
                ],
            ];
        }
        $pageTitle = 'MadeIT Codes | SaaS Ecosystem Hub';
        $isHomePage = true;
        $viewFile = __DIR__ . '/../views/home.php';
        require_once __DIR__ . '/../views/layout.php';
    }
}
