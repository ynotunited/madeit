<div class="glass-card mt-8 admin-shell" style="max-width: 800px;">
    <h1 class="admin-section-title"><?= !empty($product['id']) ? 'Edit Product' : 'Add Product' ?></h1>
    <form method="POST" action="/admin/products/save" style="display: grid; gap: 1rem; margin-top: 1.5rem;">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($product['id'] ?? '')) ?>">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Name</label>
                <input name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($errors['name']) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
                <?php if (!empty($errors['name'])): ?><div style="margin-top: 0.35rem; color: #b91c1c; font-size: 0.875rem;"><?= htmlspecialchars($errors['name']) ?></div><?php endif; ?>
            </div>
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Slug</label>
                <input name="slug" value="<?= htmlspecialchars($product['slug'] ?? '') ?>" required style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($errors['slug']) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
                <?php if (!empty($errors['slug'])): ?><div style="margin-top: 0.35rem; color: #b91c1c; font-size: 0.875rem;"><?= htmlspecialchars($errors['slug']) ?></div><?php endif; ?>
            </div>
        </div>
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Category</label>
            <input name="category" value="<?= htmlspecialchars($product['category'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid var(--glass-border); border-radius: var(--radius-sm); font-family: inherit;">
        </div>
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Description</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid var(--glass-border); border-radius: var(--radius-sm); font-family: inherit;"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
        </div>
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Long Description</label>
            <textarea name="long_description" rows="6" style="width: 100%; padding: 0.75rem; border: 1px solid var(--glass-border); border-radius: var(--radius-sm); font-family: inherit;"><?= htmlspecialchars($product['long_description'] ?? '') ?></textarea>
        </div>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">CTA Label</label>
                <input name="cta_label" value="<?= htmlspecialchars($product['cta_label'] ?? 'Launch Product') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid var(--glass-border); border-radius: var(--radius-sm); font-family: inherit;">
            </div>
            <div>
                <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">URL</label>
                <input name="url" value="<?= htmlspecialchars($product['url'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($errors['url']) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
                <?php if (!empty($errors['url'])): ?><div style="margin-top: 0.35rem; color: #b91c1c; font-size: 0.875rem;"><?= htmlspecialchars($errors['url']) ?></div><?php endif; ?>
            </div>
        </div>
        <div>
            <label style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Status</label>
            <select name="status" style="width: 100%; padding: 0.75rem; border: 1px solid var(--glass-border); border-radius: var(--radius-sm); font-family: inherit; background: white;">
                <?php foreach (['building', 'beta', 'live', 'disabled'] as $status): ?>
                    <option value="<?= $status ?>" <?= ($product['status'] ?? 'building') === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="admin-inline-actions">
            <button class="btn btn-primary" type="submit">Save Product</button>
            <button class="btn" type="submit" name="save_mode" value="continue" style="border: 1px solid var(--glass-border);">Save & Continue Editing</button>
            <a href="/admin/products" class="btn" style="border: 1px solid var(--glass-border);">Cancel</a>
        </div>
    </form>
</div>
