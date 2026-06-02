<?php
$activePage = 'terms';
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
        <h1>Terms of Use</h1>
        <div class="legal-meta">Last Updated: <?= date('F j, Y') ?></div>
        
        <p>Welcome to MadeIT Codes. These Terms of Use ("Terms") constitute a legally binding agreement between you and MadeIT Codes governing your access to and usage of our multi-SaaS platform, registry systems, and simulation components. By accessing our platform or using any ecosystem products, you acknowledge that you have read, understood, and agreed to be bound by these Terms.</p>
        
        <h3>1. Scope of Our Services</h3>
        <p>MadeIT Codes provides an intelligent host environment for discovery and operations of specialized SaaS applications. In addition, we offer the "MadeIT Flow" Simulation Engine, which helps founders, project managers, and product owners architecturalize, scope, and simulate project parameters. We reserve the right to modify, disable, or supplement any registered products or modules at our sole discretion without notice.</p>
        
        <h3>2. MadeIT Flow Simulation Advisory Disclaimer</h3>
        <p>The system architecture breakdowns, feature detection, complexity evaluations, cost ranges, and development schedules rendered by the MadeIT Flow Engine are strictly for informational and simulation purposes:</p>
        <ul>
            <li>They represent automated algorithms assessing relative complexity and baseline parameters.</li>
            <li>They do not constitute a binding contractual offer, software engineering guarantee, or definitive technical blueprint.</li>
            <li>Actual engineering scopes, pricing models, and production timelines depend on variables outside the simulation framework, including external api structures, legacy database states, and live development dynamics.</li>
        </ul>

        <h3>3. Intellectual Property Rights</h3>
        <p>All core technologies, design systems, layouts, brand indicators, database models, and engine code within the MadeIT Codes platform are the exclusive intellectual property of MadeIT Codes and our licensors. Subject to compliance with these Terms, we grant you a limited, non-exclusive, non-transferable, and revocable license to access our platform and run simulation tasks for personal or internal business discovery.</p>

        <h3>4. Prohibited Platform Activities</h3>
        <p>You agree to access and utilize the Services strictly for their intended operational purposes. You must not:</p>
        <ul>
            <li>Engage in automated data extraction, web scraping, indexing, or harvesting of simulation rules or product registry datasets.</li>
            <li>Circumvent or attempt to bypass security policies, routing locks, or admin dashboard authentications.</li>
            <li>Submit malicious payloads, spam, or high-volume automated inquiries through our keyword routing contact modules.</li>
            <li>Decompile, reverse-engineer, or attempt to recreate the proprietary logic behind the Flow Simulation engine or ecosystem frameworks.</li>
        </ul>

        <h3>5. Limitation of Liability & Warranties</h3>
        <p>Our Services are provided on an "as is" and "as available" basis, without warranties of any kind, whether express or implied. Under no circumstances shall MadeIT Codes be liable for any direct, indirect, incidental, or consequential damages resulting from your reliance on simulated cost scores, system mappings, or the unavailability of any ecosystem products.</p>

        <h3>6. Governing Law & Updates</h3>
        <p>These Terms shall be interpreted and governed in accordance with the local jurisdiction's laws. We reserve the right to revise these Terms at any time by updating this file. Your continued interaction with the platform following the publication of changes signifies your acceptance of the updated terms.</p>

        <h3>7. Inquiries</h3>
        <p>For any questions, clarifications, or support inquiries regarding these operational Terms, please submit a detailed message via our <a href="/contact">contact form</a>.</p>
    </article>
</div>
