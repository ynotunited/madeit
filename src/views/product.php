<div style="margin-top: 3rem; margin-bottom: 4rem;">
    <!-- Hero Section -->
    <div class="text-center">
        <div style="display: inline-block; padding: 0.25rem 1rem; background: rgba(59, 130, 246, 0.1); color: var(--primary); border-radius: 9999px; font-weight: 600; font-size: 0.875rem; margin-bottom: 1rem;">
            <?= htmlspecialchars($product['category'] ?? 'SaaS Product') ?>
        </div>
        <h1 style="font-size: 3rem; margin-bottom: 1rem; color: var(--text-color);"><?= htmlspecialchars($product['name']) ?></h1>
        <p class="text-muted" style="font-size: 1.25rem; max-width: 600px; margin: 0 auto 2rem;">
            <?= nl2br(htmlspecialchars($product['description'])) ?>
        </p>
        
        <div style="display: flex; gap: 1rem; justify-content: center; margin-bottom: 3rem;">
            <?php
                $productUrl = trim((string) ($product['url'] ?? ''));
                $productStatus = strtolower(trim((string) ($product['status'] ?? '')));
                $isUpcoming = $productUrl === '' || in_array($productStatus, ['coming soon', 'upcoming', 'beta', 'building'], true);
            ?>
            <?php if ($isUpcoming): ?>
                <span class="btn btn-primary btn-disabled" aria-disabled="true" style="font-size: 1.125rem; padding: 16px 32px;">
                    <?= htmlspecialchars($product['cta_label']) ?>
                </span>
            <?php else: ?>
                <a href="<?= htmlspecialchars($productUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary" style="font-size: 1.125rem; padding: 16px 32px;">
                    <?= htmlspecialchars($product['cta_label']) ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Long Description / Features -->
    <?php if (!empty($product['long_description'])): ?>
    <div class="glass-card" style="max-width: 800px; margin: 0 auto;">
        <h3 style="border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem; margin-bottom: 1rem;">About This Product</h3>
        <div style="line-height: 1.8; color: var(--text-muted);">
            <?= nl2br(htmlspecialchars($product['long_description'])) ?>
        </div>
    </div>
    <?php endif; ?>
</div>
