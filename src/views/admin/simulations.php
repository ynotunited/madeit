<div class="mt-8 mb-4 admin-shell">
    <h1 class="admin-section-title">Simulation Config</h1>
    <p class="admin-muted-note">Manage the rule keywords used by MadeIT Flow.</p>
</div>

<div class="glass-card admin-shell" style="margin-bottom: 2rem;">
    <form method="POST" action="/admin/simulations/save" style="display: grid; gap: 1rem;">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($ruleToEdit['id'] ?? '')) ?>">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 1rem;">
            <div>
                <input name="keyword" placeholder="Keyword" value="<?= htmlspecialchars($ruleToEdit['keyword'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($errors['keyword']) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
                <?php if (!empty($errors['keyword'])): ?><div style="margin-top: 0.35rem; color: #b91c1c; font-size: 0.875rem;"><?= htmlspecialchars($errors['keyword']) ?></div><?php endif; ?>
            </div>
            <div>
                <input name="module" placeholder="Module" value="<?= htmlspecialchars($ruleToEdit['module'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($errors['module']) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
                <?php if (!empty($errors['module'])): ?><div style="margin-top: 0.35rem; color: #b91c1c; font-size: 0.875rem;"><?= htmlspecialchars($errors['module']) ?></div><?php endif; ?>
            </div>
            <div>
                <input name="cost_weight" type="number" placeholder="Cost" value="<?= htmlspecialchars((string) ($ruleToEdit['cost_weight'] ?? '')) ?>" style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($errors['cost_weight']) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
                <?php if (!empty($errors['cost_weight'])): ?><div style="margin-top: 0.35rem; color: #b91c1c; font-size: 0.875rem;"><?= htmlspecialchars($errors['cost_weight']) ?></div><?php endif; ?>
            </div>
            <div>
                <input name="complexity_weight" type="number" min="1" value="<?= htmlspecialchars((string) ($ruleToEdit['complexity_weight'] ?? 1)) ?>" placeholder="Timeline" style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($errors['complexity_weight']) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
                <?php if (!empty($errors['complexity_weight'])): ?><div style="margin-top: 0.35rem; color: #b91c1c; font-size: 0.875rem;"><?= htmlspecialchars($errors['complexity_weight']) ?></div><?php endif; ?>
            </div>
        </div>
        <div class="admin-inline-actions">
            <button class="btn btn-primary" type="submit">Save Rule</button>
            <button class="btn" type="submit" name="save_mode" value="continue" style="border: 1px solid var(--glass-border);">Save & Continue Editing</button>
        </div>
    </form>
</div>

<div class="glass-card admin-shell">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Keyword</th>
                <th>Module</th>
                <th>Cost</th>
                <th>Timeline</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($rules)): ?>
                <tr><td colspan="5" style="padding: 1rem 0.5rem; color: var(--text-muted);">No rules configured yet.</td></tr>
            <?php else: ?>
                <?php foreach ($rules as $rule): ?>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <td style="font-weight: 600;"><?= htmlspecialchars($rule['keyword']) ?></td>
                        <td><?= htmlspecialchars($rule['module']) ?></td>
                        <td><?= (int) $rule['cost_weight'] ?></td>
                        <td><?= (int) $rule['complexity_weight'] ?> days</td>
                        <td>
                            <a href="/admin/simulations/edit?id=<?= (int) $rule['id'] ?>" style="color: var(--primary); text-decoration: none; margin-right: 1rem;">Edit</a>
                            <form action="/admin/simulations/delete" method="POST" style="display: inline;" onsubmit="return confirm('Delete rule &quot;<?= htmlspecialchars($rule['keyword']) ?>&quot;?');">
                                <input type="hidden" name="id" value="<?= (int) $rule['id'] ?>">
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
