<?php
$activePage = 'privacy';
?>
<div class="legal-layout">
    <aside class="legal-sidebar glass-card">
        <h2 class="sidebar-title">Trust & Legal</h2>
        <nav class="sidebar-nav">
            <a href="/privacy" class="nav-item <?= $activePage === 'privacy' ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                <span>Privacy Policy</span>
            </a>
            <a href="/terms" class="nav-item <?= $activePage === 'terms' ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span>Terms of Use</span>
            </a>
            <a href="/compliance" class="nav-item <?= $activePage === 'compliance' ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                <span>Data & Compliance</span>
            </a>
            <a href="/ip" class="nav-item <?= $activePage === 'ip' ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                <span>IP Infringement</span>
            </a>
        </nav>
    </aside>
    
    <article class="legal-content glass-card">
        <h1>Privacy Policy</h1>
        <div class="legal-meta">Last Updated: <?= date('F j, Y') ?></div>
        
        <p>MadeIT Codes ("we", "us", or "our") operates the MadeIT Codes platform, dynamic SaaS registry, and integrated simulation tools (collectively, the "Services"). We are deeply committed to respecting and protecting the privacy of our visitors and registered users. This Privacy Policy details how we collect, process, share, and protect your information when you interact with our platform.</p>
        
        <h3>1. Information We Collect</h3>
        <p>We collect information through various touchpoints in our SaaS ecosystem:</p>
        <ul>
            <li><strong>Directly Provided Information:</strong> When you submit a request via our Contact Form or register an interest, we collect your name, email address, query categories, and message details.</li>
            <li><strong>Simulation Engine Inputs:</strong> When using the MadeIT Flow simulation engine, we collect and store the text descriptions of your software ideas, complexity parameters, and selected ecosystem configurations to generate your report.</li>
            <li><strong>Technical and Usage Data:</strong> We automatically track standard metadata, such as device identifiers, browser types, referral URLs, pages visited, and timestamps. This is handled via our lightweight, privacy-oriented tracking scripts.</li>
        </ul>

        <h3>2. How We Use Your Information</h3>
        <p>We utilize the collected datasets for targeted administrative and experience-enhancement purposes:</p>
        <ul>
            <li>To compile dynamic system architecture configurations, cost estimates, and timelines in the MadeIT Flow engine.</li>
            <li>To categorize and route your contact requests using our intelligent keyword-based routing engine.</li>
            <li>To secure and analyze the performance of our multi-tenant SaaS infrastructure.</li>
            <li>To maintain an accurate audit log of system usage and prevent malicious activities.</li>
        </ul>

        <h3>3. Data Sharing & Third Parties</h3>
        <p>We do not sell, trade, or rent your personal information to third parties. We share data only with verified infrastructure providers who make our platform possible:</p>
        <ul>
            <li><strong>Hosting and Infrastructure:</strong> Our databases and application servers are hosted in secure environments protected by state-of-the-art firewall configurations.</li>
            <li><strong>Lightweight Analytics:</strong> We process anonymized click events inside the ecosystem strictly to map user flows and improve product discoverability.</li>
            <li><strong>Legal Obligations:</strong> We may disclose data when legally required to do so under federal laws or formal judicial subpoenas.</li>
        </ul>

        <h3>4. Cookies and Session Management</h3>
        <p>Unlike traditional tracking networks, we keep cookie usage to an absolute minimum. We utilize local browser storage strictly to enhance your operational experience—such as remembering returning users to auto-route them to their last visited ecosystem product, or caching unsaved simulation inputs to prevent accidental progress loss.</p>

        <h3>5. Security and Data Retention</h3>
        <p>We implement appropriate technical and organizational measures to safeguard your information against unauthorized access, alterations, or destruction. We retain contact logs and simulation data as long as necessary to fulfill the operational requirements outlined in this policy or comply with regulatory audits.</p>

        <h3>6. Your Privacy Rights</h3>
        <p>Depending on your geographic location (such as the European Economic Area under GDPR guidelines), you possess specific legal rights over your personal data. These include the right to access, rectify, or request the deletion of the data stored within our multi-SaaS systems. To exercise these rights, please contact our team immediately.</p>

        <h3>7. Contact Information</h3>
        <p>If you have any questions or feedback regarding this Privacy Policy or our ecosystem's data management operations, please reach out via our dedicated <a href="/contact">contact form</a> or submit an administrative inquiry directly.</p>
    </article>
</div>
