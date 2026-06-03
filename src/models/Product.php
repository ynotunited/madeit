<?php
require_once __DIR__ . '/../Database.php';

class Product {
    private static function ensureSeedData($db) {
        try {
            $products = [
                [
                    'BuildLedger',
                    'buildledger',
                    'BuildLedger keeps your pipeline connected so proposals, contracts, invoices, projects, and payments stop living in different tools.',
                    'Run client work, documents, and revenue from one operating system.',
                    'Request Invite',
                    'https://buildledger.madeitcodes.online/',
                    'live',
                    'Business OS',
                ],
                [
                    'ChatChow',
                    'chatchow',
                    'ChatChow is an AI-powered multi-channel restaurant ordering platform. It lets customers order through WhatsApp, Telegram, QR codes, a website chat widget, and voice while AI handles natural language, remembers preferences, and suggests upsells.',
                    'A conversational commerce tool that helps restaurants take orders through the channels customers already use.',
                    'Coming Soon',
                    '',
                    'coming soon',
                    'Food Tech',
                ],
                [
                    'Wazup Assist',
                    'wazup-assist',
                    'WazUp Assist is an AI-powered WhatsApp receptionist for businesses. It automatically replies to customer messages using your own knowledge base, captures leads from conversations, and hands off to a human agent when needed.',
                    '24/7 WhatsApp receptionist for FAQs, pricing, policies, lead capture, and human handoff.',
                    'Coming Soon',
                    '',
                    'coming soon',
                    'Customer Support',
                ],
                [
                    'Landee',
                    'landee',
                    'Landee is an internal back-office operations system for real estate developers in Nigeria. It manages estates, deals, payments, allocation, and documents from one audit-friendly workflow.',
                    'Digitise land inventory, track deal commitments, collect payments, approve allocations, and generate sale documents without relying on spreadsheets.',
                    'Coming Soon',
                    '',
                    'coming soon',
                    'Real Estate Ops',
                ],
            ];

            $stmt = $db->prepare("INSERT IGNORE INTO products (name, slug, description, long_description, cta_label, url, status, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            foreach ($products as $product) {
                $stmt->execute($product);
            }

            $disableStmt = $db->prepare("UPDATE products SET status = 'disabled' WHERE slug IN ('schoolsapp', 'madeit-flow')");
            $disableStmt->execute();

            $buildLedgerUpdate = $db->prepare("UPDATE products SET description = ?, long_description = ?, cta_label = ?, url = ?, status = ?, category = ? WHERE slug = 'buildledger'");
            $buildLedgerUpdate->execute([
                'BuildLedger keeps your pipeline connected so proposals, contracts, invoices, projects, and payments stop living in different tools.',
                'Run client work, documents, and revenue from one operating system.',
                'Request Invite',
                'https://buildledger.madeitcodes.online/',
                'live',
                'Business OS',
            ]);

            $landeeUpdate = $db->prepare("UPDATE products SET description = ?, long_description = ?, cta_label = ?, url = ?, status = ?, category = ? WHERE slug = 'landee'");
            $landeeUpdate->execute([
                'Landee is an internal back-office operations system for real estate developers in Nigeria. It manages estates, deals, payments, allocation, and documents from one audit-friendly workflow.',
                'Digitise land inventory, track deal commitments, collect payments, approve allocations, and generate sale documents without relying on spreadsheets.',
                'Coming Soon',
                '',
                'coming soon',
                'Real Estate Ops',
            ]);

            $wazupUpdate = $db->prepare("UPDATE products SET description = ?, long_description = ?, cta_label = ?, url = ?, status = ?, category = ? WHERE slug = 'wazup-assist'");
            $wazupUpdate->execute([
                'WazUp Assist is an AI-powered WhatsApp receptionist for businesses. It automatically replies to customer messages using your own knowledge base, captures leads from conversations, and hands off to a human agent when needed.',
                '24/7 WhatsApp receptionist for FAQs, pricing, policies, lead capture, and human handoff.',
                'Coming Soon',
                '',
                'coming soon',
                'Customer Support',
            ]);

            $chatChowUpdate = $db->prepare("UPDATE products SET description = ?, long_description = ?, cta_label = ?, url = ?, status = ?, category = ? WHERE slug = 'chatchow'");
            $chatChowUpdate->execute([
                'ChatChow is an AI-powered multi-channel restaurant ordering platform. It lets customers order through WhatsApp, Telegram, QR codes, a website chat widget, and voice while AI handles natural language, remembers preferences, and suggests upsells.',
                'A conversational commerce tool that helps restaurants take orders through the channels customers already use.',
                'Coming Soon',
                '',
                'coming soon',
                'Food Tech',
            ]);

            $landeeUpdate = $db->prepare("UPDATE products SET description = ?, long_description = ?, cta_label = ?, url = ?, status = ?, category = ? WHERE slug = 'landee'");
            $landeeUpdate->execute([
                'Landee is an internal back-office operations system for real estate developers in Nigeria. It manages estates, deals, payments, allocation, and documents from one audit-friendly workflow.',
                'Digitise land inventory, track deal commitments, collect payments, approve allocations, and generate sale documents without relying on spreadsheets.',
                'Coming Soon',
                '',
                'coming soon',
                'Real Estate Ops',
            ]);
        } catch (Throwable $e) {
            // Ignore seed failures so the page can still render.
        }
    }

    public static function getAllActive() {
        try {
            $db = Database::getConnection();
            self::ensureSeedData($db);
            $stmt = $db->prepare("SELECT * FROM products WHERE status != 'disabled' ORDER BY CASE WHEN status = 'live' THEN 0 WHEN status = 'beta' THEN 1 WHEN status = 'coming soon' THEN 2 WHEN status = 'building' THEN 3 ELSE 4 END, CASE WHEN slug = 'buildledger' THEN 0 ELSE 1 END, id DESC");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Throwable $e) {
            return [];
        }
    }

    public static function getBySlug($slug) {
        try {
            $db = Database::getConnection();
            self::ensureSeedData($db);
            $stmt = $db->prepare("SELECT * FROM products WHERE slug = ?");
            $stmt->execute([$slug]);
            return $stmt->fetch();
        } catch (Throwable $e) {
            return null;
        }
    }
}
