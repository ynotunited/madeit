<section id="products" class="mt-8 mb-8">
    <div class="ecosystem-intro">
        <div class="ecosystem-kicker">Our Ecosystem</div>
        <h2>Products designed to solve real work</h2>
        <p>Each product in the madeIT ecosystem is built to reduce friction, improve clarity, and help teams move from idea to launch with confidence.</p>
    </div>
    
    <?php if (empty($products)): ?>
        <div class="glass-card ecosystem-fallback text-center">
            <p class="text-muted">No products launched yet. Check back soon!</p>
        </div>
    <?php else: ?>
        <div class="product-grid">
            <?php
            $accentPalettes = [
                ['#4A8FE8', '#2D64C8', 'rgba(74, 143, 232, 0.16)'],
                ['#7C5CFF', '#4F46E5', 'rgba(124, 92, 255, 0.16)'],
                ['#14B8A6', '#0F766E', 'rgba(20, 184, 166, 0.16)'],
                ['#F97316', '#EA580C', 'rgba(249, 115, 22, 0.16)'],
            ];
            $i = 0;
            foreach ($products as $product):
                $palette = $accentPalettes[$i % count($accentPalettes)];
                $initial = strtoupper(substr(trim((string) ($product['name'] ?? 'M')), 0, 1));
                $rawStatus = strtolower(trim((string) ($product['status'] ?? 'live')));
                $statusLabel = $rawStatus === 'beta'
                    ? 'Beta'
                    : (in_array($rawStatus, ['upcoming', 'soon', 'coming soon'], true) ? 'Coming Soon' : ucfirst($rawStatus ?: 'Live'));
            ?>
                <div class="product-card" style="--accent-start: <?= htmlspecialchars($palette[0]) ?>; --accent-end: <?= htmlspecialchars($palette[1]) ?>; --accent-soft: <?= htmlspecialchars($palette[2]) ?>;">
                    <div class="product-art">
                        <div class="product-art-glow"></div>
                        <div class="product-art-orb"></div>
                        <div class="product-art-mark"><?= htmlspecialchars($initial) ?></div>
                    </div>

                    <div class="product-card-header">
                        <div class="product-badge">Product</div>
                        <div class="product-status <?= htmlspecialchars(strtolower($statusLabel)) ?>"><?= htmlspecialchars($statusLabel) ?></div>
                    </div>

                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p><?= htmlspecialchars($product['description']) ?></p>

                    <?php
                        $ctaLabel = trim((string) ($product['cta_label'] ?? 'View Product'));
                        $productStatus = strtolower(trim((string) ($product['status'] ?? 'live')));
                        $isUpcoming = in_array($productStatus, ['beta', 'upcoming', 'soon', 'coming soon'], true);
                        $ctaHref = (!$isUpcoming && !empty($product['url'])) ? trim((string) $product['url']) : '';
                    ?>
                    <div class="product-card-footer">
                        <div class="product-meta">
                            <span><?= htmlspecialchars($product['category'] ?? 'SaaS') ?></span>
                            <span><?= htmlspecialchars($statusLabel) ?></span>
                            <span>madeIT</span>
                        </div>
                        <?php if ($ctaHref !== ''): ?>
                            <a href="<?= htmlspecialchars($ctaHref) ?>" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                                <?= htmlspecialchars($ctaLabel) ?>
                            </a>
                        <?php else: ?>
                            <span class="btn btn-primary btn-disabled" aria-disabled="true">
                                <?= htmlspecialchars($ctaLabel) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php
                $i++;
            endforeach;
            ?>
        </div>
    <?php endif; ?>
</section>

<section class="glass-card mt-8 text-center" style="background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(249, 115, 22, 0.1) 100%); border-color: rgba(59, 130, 246, 0.3);">
    <h2>Have an idea?</h2>
    <p class="text-muted mb-4">Simulate it before building it with our MadeIT Flow engine.</p>
    <a href="/flow" class="btn btn-cta">Launch Flow Simulator</a>
</section>
