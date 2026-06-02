<div class="text-center mt-4 mb-8">
    <h1 style="color: var(--primary);">MadeIT Flow</h1>
    <p class="text-muted">Describe your idea, and we'll simulate the system architecture, cost, and timeline.</p>
</div>

<div style="display: grid; grid-template-columns: 1fr; gap: 2rem; max-width: 900px; margin: 0 auto;">
    
    <!-- Input Section -->
    <div class="glass-card">
        <h3>What do you want to build?</h3>
        <textarea id="ideaInput" rows="5" placeholder="e.g., A real-time chat app with user login and Stripe payments..." style="width: 100%; padding: 1rem; border-radius: var(--radius-md); border: 1px solid var(--glass-border); font-family: inherit; margin-top: 1rem; resize: vertical; background: rgba(255,255,255,0.8);"></textarea>
        <button id="simulateBtn" class="btn btn-primary mt-4" style="width: 100%;">Simulate Idea</button>
    </div>

    <!-- Output Section (Hidden initially) -->
    <div id="simulationResult" class="glass-card" style="display: none; transition: opacity 0.3s ease;">
        <h3 style="border-bottom: 1px solid var(--glass-border); padding-bottom: 0.5rem; margin-bottom: 1rem;">Simulation Report</h3>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div style="background: rgba(255,255,255,0.5); padding: 1rem; border-radius: var(--radius-sm);">
                <div style="font-size: 0.875rem; color: var(--text-muted);">Estimated Cost</div>
                <div id="costDisplay" style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">-</div>
            </div>
            <div style="background: rgba(255,255,255,0.5); padding: 1rem; border-radius: var(--radius-sm);">
                <div style="font-size: 0.875rem; color: var(--text-muted);">Estimated Timeline</div>
                <div id="timelineDisplay" style="font-size: 1.5rem; font-weight: 700; color: var(--primary);">-</div>
            </div>
        </div>

        <h4>Detected Modules</h4>
        <ul id="modulesList" style="list-style: none; margin-top: 0.5rem; padding: 0;">
            <!-- Modules injected here via JS -->
        </ul>
        
        <div class="mt-8 text-center">
            <p class="text-muted mb-4" style="font-size: 0.875rem;">Ready to make it real?</p>
            <a href="/contact?intent=build" class="btn btn-cta" style="width: 100%;">Contact Us to Build This</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const simulateBtn = document.getElementById('simulateBtn');
    const ideaInput = document.getElementById('ideaInput');
    const resultCard = document.getElementById('simulationResult');
    const costDisplay = document.getElementById('costDisplay');
    const timelineDisplay = document.getElementById('timelineDisplay');
    const modulesList = document.getElementById('modulesList');

    simulateBtn.addEventListener('click', async () => {
        const idea = ideaInput.value.trim();
        if (!idea) return;

        // Visual loading state
        simulateBtn.disabled = true;
        simulateBtn.textContent = 'Simulating...';
        resultCard.style.opacity = '0.5';

        try {
            const response = await fetch('/api/flow/simulate', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ idea })
            });
            
            const result = await response.json();
            
            if (result.success) {
                const data = result.data;
                costDisplay.textContent = data.cost_range;
                timelineDisplay.textContent = data.timeline;
                
                modulesList.innerHTML = '';
                data.modules.forEach(mod => {
                    const li = document.createElement('li');
                    li.style.padding = '0.75rem';
                    li.style.background = 'rgba(255,255,255,0.5)';
                    li.style.marginBottom = '0.5rem';
                    li.style.borderRadius = '0.25rem';
                    li.innerHTML = `<strong>${mod.name}</strong> <span style="float:right; color:var(--text-muted); font-size:0.875rem;">~$${mod.cost}</span>`;
                    modulesList.appendChild(li);
                });

                resultCard.style.display = 'block';
                setTimeout(() => resultCard.style.opacity = '1', 50);
            }
        } catch (e) {
            console.error('Simulation failed', e);
        } finally {
            simulateBtn.disabled = false;
            simulateBtn.textContent = 'Simulate Idea';
        }
    });
});
</script>
