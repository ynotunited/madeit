<?php
$activePage = 'ip';
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
        <h1>Intellectual Property & Infringement Policy</h1>
        <div class="legal-meta">Last Updated: <?= date('F j, Y') ?></div>
        
        <p>MadeIT Codes respects the intellectual property rights of creators, developers, and organizations. We expect all users, founders, and administrators within our multi-SaaS ecosystem to demonstrate the same level of respect. This IP Infringement Policy outlines our procedures for reporting alleged copyright and trademark infringements and our protocols for handling counter-notices.</p>
        
        <h3>1. Reporting Intellectual Property Infringement</h3>
        <p>If you believe that any material hosted in our registry, simulation engine, or sub-SaaS applications infringes upon your copyright or trademark, you or your authorized representative may submit a formal notice of infringement. In accordance with DMCA and global IP frameworks, the notice must contain the following information:</p>
        <ul>
            <li>A physical or electronic signature of the copyright or trademark owner or an authorized representative acting on their behalf.</li>
            <li>Clear identification of the copyrighted work or registered trademark claimed to have been infringed.</li>
            <li>Specific identification of the infringing material and its location within our ecosystem (including the exact URL/slug, e.g., <code>/product/some-slug</code>).</li>
            <li>Your direct contact details, including a physical mailing address, telephone number, and email address.</li>
            <li>A statement that you have a good faith belief that the use of the material in the manner complained of is not authorized by the rights holder, its agent, or the law.</li>
            <li>A statement, made under penalty of perjury, that the information in your notification is accurate and that you are the owner or authorized to act on behalf of the owner of the exclusive right that is allegedly infringed.</li>
        </ul>
        <p>All formal notifications of copyright infringement should be submitted through our <a href="/contact">contact form</a>, selecting the IP/Legal inquiry category for expedited processing.</p>

        <h3>2. Our Takedown Process</h3>
        <p>Upon receiving a fully compliant and verified notice of infringement, we will act promptly to remove or restrict access to the allegedly infringing content. We will also make a reasonable, good-faith attempt to notify the user or administrator who published the material, providing them with a copy of the infringement report and instructions on how to submit a counter-notification.</p>

        <h3>3. Counter-Notification Procedure</h3>
        <p>If you believe your content was removed or disabled by mistake or misidentification, you may submit a formal written Counter-Notification to our designated agent. The counter-notice must include:</p>
        <ul>
            <li>Your physical or electronic signature.</li>
            <li>Identification of the material that was removed or disabled and the exact location it occupied before removal.</li>
            <li>A statement, under penalty of perjury, that you have a good faith belief that the material was removed or disabled as a result of mistake or misidentification.</li>
            <li>Your name, physical address, and telephone number, along with a statement that you consent to the jurisdiction of the federal or local court in which your address is located (or if outside, the appropriate judicial district), and that you will accept service of process from the person who provided the original infringement notice.</li>
        </ul>
        <p>If we receive a valid counter-notice, we may restore the removed material after 10 to 14 business days, unless the original complaining party files a formal lawsuit seeking a court order to restrain the content from being republished.</p>

        <h3>4. Repeat Infringer Policy</h3>
        <p>In accordance with global digital laws, MadeIT Codes maintains a strict Repeat Infringer Policy. We reserve the right to terminate, deactivate, or completely remove the registration rights, administrative privileges, or SaaS subdomains of any user or developer who is determined to have repeatedly violated the intellectual property rights of others.</p>

        <h3>5. Trademark Infringement Guidelines</h3>
        <p>Unauthorized use of business names, trademarks, or proprietary logos in a manner that causes customer confusion or misleads the public regarding product origin is prohibited across our multi-tenant SaaS environments. Reports of trademark infringement are subject to immediate internal review, and we reserve the right to reassign registry slugs or disable subdomains to resolve legitimate trademark disputes.</p>
    </article>
</div>
