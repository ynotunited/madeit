<?php
$projects = [
    [
        'name' => 'BuildLedger',
        'status' => 'Live',
        'badge_class' => 'live',
        'problem' => 'Construction accounting is fragmented.',
        'outcome' => 'Unified ledger platform specifically for service-based teams.',
        'cta' => 'Request Invite',
        'href' => 'https://buildledger.madeitcodes.online/',
    ],
    [
        'name' => 'ChatChow',
        'status' => 'Coming Soon',
        'badge_class' => 'coming-soon',
        'problem' => 'Restaurants need one ordering system that works across the channels customers already use.',
        'outcome' => 'AI-powered multi-channel restaurant ordering across WhatsApp, Telegram, QR codes, website chat, and voice.',
        'cta' => 'Coming Soon',
        'href' => '',
    ],
    [
        'name' => 'Wazup Assist',
        'status' => 'Coming Soon',
        'badge_class' => 'coming-soon',
        'problem' => 'Businesses need a responsive WhatsApp front desk that never sleeps.',
        'outcome' => 'AI-powered WhatsApp receptionist that answers from your knowledge base, captures leads, and hands off to humans when needed.',
        'cta' => 'Coming Soon',
        'href' => '',
    ],
    [
        'name' => 'Landee',
        'status' => 'Coming Soon',
        'badge_class' => 'coming-soon',
        'problem' => 'Land sales operations are still tracked in spreadsheets, creating double-selling risk and no audit trail.',
        'outcome' => 'An internal back-office system for real estate developers to manage estates, deals, payments, allocations, and documents.',
        'cta' => 'Coming Soon',
        'href' => '',
    ],
];
?>

<div class="mt-8 text-center">
    <h1 style="color: var(--primary);">Ecosystem Proof</h1>
    <p class="text-muted" style="max-width: 600px; margin: 0 auto 3rem;">
        See what we've built, what's live, and what's coming soon.
    </p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
    <?php foreach ($projects as $project): ?>
        <div class="glass-card">
            <div style="display: inline-block; padding: 0.25rem 0.75rem; background: <?= $project['badge_class'] === 'live' ? 'rgba(20, 184, 166, 0.12)' : ($project['badge_class'] === 'beta' ? 'rgba(74, 143, 232, 0.1)' : 'rgba(124, 92, 255, 0.1)') ?>; color: <?= $project['badge_class'] === 'live' ? '#0F766E' : ($project['badge_class'] === 'beta' ? 'var(--primary)' : '#7C5CFF') ?>; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; margin-bottom: 1rem;">
                <?= htmlspecialchars($project['status']) ?>
            </div>
            <h3><?= htmlspecialchars($project['name']) ?></h3>
            <p class="text-muted" style="margin-bottom: 1rem;"><strong>Problem:</strong> <?= htmlspecialchars($project['problem']) ?></p>
            <p class="text-muted" style="margin-bottom: 1.5rem;"><strong>Outcome:</strong> <?= htmlspecialchars($project['outcome']) ?></p>
            <?php if (!empty($project['href'])): ?>
                <a href="<?= htmlspecialchars($project['href']) ?>" class="btn btn-primary"><?= htmlspecialchars($project['cta']) ?></a>
            <?php else: ?>
                <span class="btn btn-primary btn-disabled" aria-disabled="true"><?= htmlspecialchars($project['cta']) ?></span>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
