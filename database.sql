-- MadeIT Codes Database Schema

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    long_description TEXT,
    cta_label VARCHAR(100) DEFAULT 'Launch Product',
    url VARCHAR(255),
    status ENUM('live', 'beta', 'building', 'disabled') DEFAULT 'building',
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS leads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    intent VARCHAR(255),
    category VARCHAR(100),
    message TEXT,
    source VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS simulations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idea_text TEXT NOT NULL,
    modules_json JSON,
    cost_range VARCHAR(100),
    timeline VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS analytics (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event VARCHAR(100) NOT NULL,
    properties JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS product_rules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    keyword VARCHAR(255) NOT NULL,
    module VARCHAR(255) NOT NULL,
    cost_weight INT DEFAULT 0,
    complexity_weight INT DEFAULT 0,
    UNIQUE KEY uniq_product_rules_keyword (keyword)
);

INSERT IGNORE INTO product_rules (keyword, module, cost_weight, complexity_weight) VALUES
('payment', 'Stripe Payments', 500, 3),
('auth', 'User Authentication', 200, 1),
('login', 'User Authentication', 200, 1),
('ai', 'AI Integration', 1500, 7),
('chat', 'Real-time Chat', 800, 5),
('dashboard', 'Admin Dashboard', 600, 4),
('api', 'REST API', 400, 2);

INSERT IGNORE INTO products (name, slug, description, long_description, cta_label, url, status, category) VALUES
('BuildLedger', 'buildledger', 'BuildLedger keeps your pipeline connected so proposals, contracts, invoices, projects, and payments stop living in different tools.', 'Run client work, documents, and revenue from one operating system.', 'Request Invite', 'https://buildledger.madeitcodes.online/', 'live', 'Business OS'),
('ChatChow', 'chatchow', 'ChatChow is an AI-powered multi-channel restaurant ordering platform. It lets customers order through WhatsApp, Telegram, QR codes, a website chat widget, and voice while AI handles natural language, remembers preferences, and suggests upsells.', 'A conversational commerce tool that helps restaurants take orders through the channels customers already use.', 'Coming Soon', '', 'coming soon', 'Food Tech'),
('Wazup Assist', 'wazup-assist', 'WazUp Assist is an AI-powered WhatsApp receptionist for businesses. It automatically replies to customer messages using your own knowledge base, captures leads from conversations, and hands off to a human agent when needed.', '24/7 WhatsApp receptionist for FAQs, pricing, policies, lead capture, and human handoff.', 'Coming Soon', '', 'coming soon', 'Customer Support'),
('Landee', 'landee', 'Landee is an internal back-office operations system for real estate developers in Nigeria. It manages estates, deals, payments, allocation, and documents from one audit-friendly workflow.', 'Digitise land inventory, track deal commitments, collect payments, approve allocations, and generate sale documents without relying on spreadsheets.', 'Coming Soon', '', 'coming soon', 'Real Estate Ops');
