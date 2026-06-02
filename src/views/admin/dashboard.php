<div class="glass-card mt-8 admin-shell">
    <h1 class="text-center admin-section-title" style="border-bottom: 1px solid var(--glass-border); padding-bottom: 1rem;">Admin Control Center</h1>
    <p class="text-center admin-muted-note" style="margin-top: 1rem;">Signed in as <?= htmlspecialchars($_SESSION['madeit_admin_user']['username'] ?? 'admin') ?></p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
        
        <a href="/admin/products" style="text-decoration: none; color: inherit;">
            <div class="glass-card text-center" style="transition: transform 0.2s; cursor: pointer;">
                <h3 style="color: var(--primary);">Products Manager</h3>
                <p class="text-muted" style="font-size: 0.875rem;">Add, edit, or disable SaaS products.</p>
            </div>
        </a>

        <a href="/admin/simulations" style="text-decoration: none; color: inherit;">
            <div class="glass-card text-center" style="transition: transform 0.2s; cursor: pointer;">
                <h3 style="color: var(--primary);">Simulation Config</h3>
                <p class="text-muted" style="font-size: 0.875rem;">Adjust cost weights & complexity rules.</p>
            </div>
        </a>

        <a href="/admin/leads" style="text-decoration: none; color: inherit;">
            <div class="glass-card text-center" style="transition: transform 0.2s; cursor: pointer;">
                <h3 style="color: var(--primary);">Leads & Analytics</h3>
                <p class="text-muted" style="font-size: 0.875rem;">View contact submissions and tracking.</p>
            </div>
        </a>

    </div>
</div>
