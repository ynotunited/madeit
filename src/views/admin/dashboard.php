<div class="glass-card mt-8 admin-shell">
    <h1 class="text-center admin-section-title" style="border-bottom: 1px solid var(--glass-border); padding-bottom: 1rem;">Admin Control Center</h1>
    <p class="text-center admin-muted-note" style="margin-top: 1rem;">Signed in as <?= htmlspecialchars($_SESSION['madeit_admin_user']['username'] ?? 'admin') ?></p>

    <?php
        $diagItems = [
            [
                'label' => 'Admin credentials',
                'ok' => madeit_env('MADEIT_ADMIN_USER') !== '' && madeit_env('MADEIT_ADMIN_PASSWORD') !== '',
                'value' => madeit_env('MADEIT_ADMIN_USER') !== '' ? 'Configured' : 'Missing',
            ],
            [
                'label' => 'Flow email',
                'ok' => madeit_env('MADEIT_FLOW_NOTIFICATION_EMAIL') !== '',
                'value' => madeit_env('MADEIT_FLOW_NOTIFICATION_EMAIL') !== '' ? madeit_env('MADEIT_FLOW_NOTIFICATION_EMAIL') : 'Not set',
            ],
            [
                'label' => 'Telegram bot',
                'ok' => madeit_env('MADEIT_TELEGRAM_BOT_TOKEN') !== '',
                'value' => madeit_env('MADEIT_TELEGRAM_BOT_TOKEN') !== '' ? 'Configured' : 'Missing token',
            ],
            [
                'label' => 'Telegram chat ID',
                'ok' => madeit_env('MADEIT_TELEGRAM_CHAT_ID') !== '',
                'value' => madeit_env('MADEIT_TELEGRAM_CHAT_ID') !== '' ? madeit_env('MADEIT_TELEGRAM_CHAT_ID') : 'Not set',
            ],
            [
                'label' => 'Idea webhook',
                'ok' => madeit_env('MADEIT_IDEA_FLOW_WEBHOOK_URL') !== '',
                'value' => madeit_env('MADEIT_IDEA_FLOW_WEBHOOK_URL') !== '' ? 'Configured' : 'Optional',
            ],
        ];
    ?>

    <div class="glass-card" style="margin-top: 1.25rem; padding: 1rem 1.25rem;">
        <h3 style="margin-bottom: 0.75rem; color: var(--primary);">System Checks</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 0.75rem;">
            <?php foreach ($diagItems as $item): ?>
                <div style="padding: 0.85rem 0.9rem; border-radius: var(--radius-md); border: 1px solid var(--glass-border); background: rgba(255,255,255,0.55);">
                    <div style="display:flex; align-items:center; justify-content:space-between; gap: 0.75rem; margin-bottom: 0.35rem;">
                        <strong style="font-size: 0.9rem;"><?= htmlspecialchars($item['label']) ?></strong>
                        <span style="display:inline-flex; align-items:center; justify-content:center; min-width: 56px; padding: 0.2rem 0.55rem; border-radius: 999px; font-size: 0.72rem; font-weight: 700; color: <?= $item['ok'] ? '#0f766e' : '#b91c1c' ?>; background: <?= $item['ok'] ? 'rgba(20, 184, 166, 0.12)' : 'rgba(239, 68, 68, 0.12)' ?>;">
                            <?= $item['ok'] ? 'OK' : 'Check' ?>
                        </span>
                    </div>
                    <div class="admin-muted-note" style="font-size: 0.85rem; line-height: 1.5;"><?= htmlspecialchars($item['value']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="admin-muted-note" style="margin-top: 0.75rem; font-size: 0.85rem;">If Telegram is not sending, confirm the bot token is real, send the bot a message once, and make sure the chat ID is filled in.</p>
    </div>
    
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
