<?php
$selectedLead = null;
if (!empty($_GET['lead_id'])) {
    foreach ($leads as $leadItem) {
        if ((int) $leadItem['id'] === (int) $_GET['lead_id']) {
            $selectedLead = $leadItem;
            break;
        }
    }
}
?>
<div class="mt-8 mb-4 admin-shell">
    <h1 class="admin-section-title">Leads & Analytics</h1>
    <p class="admin-muted-note">Review contact submissions captured from the site.</p>
</div>

<div class="glass-card admin-shell">
    <table class="admin-table" style="margin-top: 1rem;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Intent</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($leads)): ?>
                <tr><td colspan="4" style="padding: 1rem 0.5rem; color: var(--text-muted);">No leads yet.</td></tr>
            <?php else: ?>
                <?php foreach ($leads as $lead): ?>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <td style="font-size: 0.875rem;"><?= htmlspecialchars($lead['created_at']) ?></td>
                        <td style="font-weight: 600;"><?= htmlspecialchars($lead['name']) ?></td>
                        <td><?= htmlspecialchars($lead['intent'] ?? '') ?></td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-primary"
                                style="padding: 6px 12px; font-size: 0.875rem; margin-right: 0.75rem;"
                                data-lead-view
                                data-id="<?= (int) $lead['id'] ?>"
                                data-name="<?= htmlspecialchars($lead['name'], ENT_QUOTES) ?>"
                                data-email="<?= htmlspecialchars($lead['email'], ENT_QUOTES) ?>"
                                data-intent="<?= htmlspecialchars($lead['intent'] ?? '', ENT_QUOTES) ?>"
                                data-category="<?= htmlspecialchars($lead['category'] ?? '', ENT_QUOTES) ?>"
                                data-source="<?= htmlspecialchars($lead['source'] ?? '', ENT_QUOTES) ?>"
                                data-message="<?= htmlspecialchars($lead['message'] ?? '', ENT_QUOTES) ?>"
                                data-created-at="<?= htmlspecialchars($lead['created_at'], ENT_QUOTES) ?>"
                            >View</button>
                            <form action="/admin/leads/delete" method="POST" style="display: inline;" onsubmit="return confirm('Delete lead &quot;<?= htmlspecialchars($lead['name']) ?>&quot;?');">
                                <input type="hidden" name="id" value="<?= (int) $lead['id'] ?>">
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

<div id="leadModal" style="display: none; position: fixed; inset: 0; background: rgba(13, 17, 23, 0.55); z-index: 1000; padding: 2rem;">
    <div class="glass-card" style="max-width: 720px; margin: 5vh auto 0; position: relative;">
        <button id="leadModalClose" type="button" aria-label="Close" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">×</button>
        <div style="display: flex; justify-content: space-between; gap: 1rem; align-items: start; margin-bottom: 1rem;">
            <div>
                <h2 id="leadModalName" style="margin-bottom: 0.25rem;">Lead</h2>
                <div id="leadModalMeta" class="text-muted" style="font-size: 0.875rem;"></div>
            </div>
            <span id="leadModalIntent" style="padding: 0.35rem 0.75rem; border-radius: 999px; background: rgba(59, 130, 246, 0.1); color: var(--primary); font-size: 0.875rem;"></span>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1rem;">
            <div><strong>Email:</strong><div id="leadModalEmail" class="text-muted"></div></div>
            <div><strong>Category:</strong><div id="leadModalCategory" class="text-muted"></div></div>
            <div><strong>Source:</strong><div id="leadModalSource" class="text-muted"></div></div>
        </div>
        <div>
            <strong>Message</strong>
            <div id="leadModalMessage" style="margin-top: 0.5rem; line-height: 1.75; white-space: pre-wrap;"></div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('leadModal');
    const closeBtn = document.getElementById('leadModalClose');
    const leadButtons = document.querySelectorAll('[data-lead-view]');

    const openModal = (button) => {
        document.getElementById('leadModalName').textContent = button.dataset.name || '';
        document.getElementById('leadModalMeta').textContent = button.dataset.createdAt || '';
        document.getElementById('leadModalIntent').textContent = button.dataset.intent || 'General inquiry';
        document.getElementById('leadModalEmail').textContent = button.dataset.email || '';
        document.getElementById('leadModalCategory').textContent = button.dataset.category || '';
        document.getElementById('leadModalSource').textContent = button.dataset.source || '';
        document.getElementById('leadModalMessage').textContent = button.dataset.message || '';
        modal.style.display = 'block';
    };

    leadButtons.forEach((button) => button.addEventListener('click', () => openModal(button)));
    closeBtn.addEventListener('click', () => { modal.style.display = 'none'; });
    modal.addEventListener('click', (event) => {
        if (event.target === modal) modal.style.display = 'none';
    });

    <?php if ($selectedLead): ?>
    const initialButton = document.querySelector('[data-lead-view][data-id="<?= (int) $selectedLead['id'] ?>"]');
    if (initialButton) openModal(initialButton);
    <?php endif; ?>
});
</script>
