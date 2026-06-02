<div class="mt-8 mb-4 admin-toolbar admin-shell">
    <h1 class="admin-section-title">Products Manager</h1>
    <a href="/admin/products/new" class="btn btn-primary" style="padding: 8px 16px;">+ Add Product</a>
</div>

<div class="glass-card admin-shell">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="4" style="padding: 1rem 0.5rem; color: var(--text-muted);">No products found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <td style="font-weight: 600;"><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['slug']) ?></td>
                        <td><?= htmlspecialchars(ucfirst($product['status'])) ?></td>
                        <td>
                            <a href="/admin/products/edit?id=<?= (int) $product['id'] ?>" style="color: var(--primary); text-decoration: none; margin-right: 1rem;">Edit</a>
                            <form action="/admin/products/delete" method="POST" style="display: inline;" onsubmit="return confirm('Delete product &quot;<?= htmlspecialchars($product['name']) ?>&quot;?');">
                                <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; padding: 0;">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <div class="mt-4">
        <a href="/admin" class="admin-subtle-link">&larr; Back to Dashboard</a>
    </div>
</div>
