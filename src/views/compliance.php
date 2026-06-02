<?php
$activePage = 'compliance';
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
        <h1>Data & Compliance</h1>
        <div class="legal-meta">Last Updated: <?= date('F j, Y') ?></div>
        
        <p>MadeIT Codes is built on a foundation of security, transparency, and architectural rigor. As a multi-SaaS ecosystem, we ensure that every application in our registry meets high security standards and complies with international data frameworks. This page outlines our technical safeguards, operational compliance, and security practices.</p>
        
        <h3>1. Infrastructure Security Controls</h3>
        <p>We deploy robust, multi-layered defenses to maintain high availability and prevent data leakage:</p>
        <ul>
            <li><strong>Data Encryption:</strong> All traffic traversing the platform is encrypted in transit using industry-standard SSL/TLS cryptographic protocols. Core database files are encrypted at rest.</li>
            <li><strong>Network Safeguards:</strong> Our production servers operate behind firewalls with intelligent intrusion detection, rate-limiting rules, and automated traffic filtering.</li>
            <li><strong>Backups & Redundancy:</strong> We run automated daily database backups stored in isolated, geographically redundant environments to assure disaster recovery capability.</li>
        </ul>

        <h3>2. GDPR Compliance</h3>
        <p>For individuals residing in the European Economic Area (EEA), we actively uphold the data protection principles defined by the General Data Protection Regulation (GDPR):</p>
        <ul>
            <li><strong>Transparency & Consent:</strong> We collect only the data necessary to provide ecosystem services and explicitly detail our processing actions.</li>
            <li><strong>User Sovereignty:</strong> You have the right to request access to, correction of, or permanent deletion of your stored user records.</li>
            <li><strong>Data Portability:</strong> Users can request to export their contact and simulation records in structured JSON or CSV formats.</li>
        </ul>

        <h3>3. Specialized SaaS Regulatory Compliance</h3>
        <p>Certain products hosted in our registry process highly sensitive sector-specific data. We configure these modules to satisfy respective regulatory frameworks:</p>
        <ul>
            <li><strong>COPPA & FERPA (Educational Systems):</strong> Products in our ecosystem like <em>SchoolsApp</em> conform to strict guidelines under the Children's Online Privacy Protection Act (COPPA) and Family Educational Rights and Privacy Act (FERPA), ensuring that student data is partitioned, never commercialized, and strictly managed under school district authorizations.</li>
            <li><strong>Financial Standards:</strong> Any SaaS components handling payment subscriptions offload transactions to PCI-DSS compliant credit card processors. No raw banking or card records are stored directly in our primary databases.</li>
        </ul>

        <h3>4. Data Residency & Subprocessors</h3>
        <p>By default, our primary cloud services are deployed in secure data centers. When creating sub-accounts or deploying subdomains for isolated SaaS services (e.g., dedicated database instances for BuildLedger), we maintain clear separation policies to satisfy regional data residency requirements specified by enterprise clients.</p>

        <h3>5. Incident Response & Disclosure</h3>
        <p>In the event of a suspected security anomaly, we maintain an active Incident Response Protocol to contain, evaluate, and mitigate risks. Affected parties and governing authorities will be notified in accordance with local legal timelines. If you are a security researcher and have discovered a vulnerability on our platform, please report it privately through our contact system for rapid remediation.</p>

        <h3>6. Regulatory Requests</h3>
        <p>If you represent a compliance auditing body or wish to submit a formal Data Subject Access Request (DSAR), please use our <a href="/contact">contact page</a>, selecting the appropriate compliance category.</p>
    </article>
</div>
