<div class="glass-card" style="max-width: 480px; margin: 4rem auto 0;">
    <h1 class="text-center" style="color: var(--primary);">Admin Login</h1>
    <p class="text-center text-muted">Sign in to manage products, leads, and simulation rules.</p>

    <?php if (!empty($error)): ?>
        <div style="margin: 1rem 0; padding: 0.875rem 1rem; border-radius: var(--radius-md); background: rgba(239, 68, 68, 0.12); color: #b91c1c; font-weight: 600;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/admin/login" id="adminLoginForm" style="display: grid; gap: 1rem; margin-top: 1.5rem;" novalidate>
        <div>
            <label for="username" style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Username</label>
            <input id="username" name="username" type="text" required maxlength="80" autocomplete="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($error) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
            <div style="display:flex; justify-content:space-between; gap:10px; margin-top:0.35rem;">
                <small id="usernameError" style="color:#ef4444;"></small>
                <small id="usernameCount" style="color:#9ca3af;">0/80</small>
            </div>
        </div>
        <div>
            <label for="password" style="font-weight: 600; display: block; margin-bottom: 0.5rem;">Password</label>
            <input id="password" name="password" type="password" required minlength="8" autocomplete="current-password" style="width: 100%; padding: 0.75rem; border: 1px solid <?= !empty($error) ? '#ef4444' : 'var(--glass-border)' ?>; border-radius: var(--radius-sm); font-family: inherit;">
            <div style="display:flex; justify-content:space-between; gap:10px; margin-top:0.35rem;">
                <small id="passwordError" style="color:#ef4444;"></small>
                <small id="passwordCount" style="color:#9ca3af;">0/72</small>
            </div>
            <small id="passwordHelp" style="display:block; margin-top:0.4rem; color:#6b7280;">
                Use at least 8 characters with a mix of letters and numbers.
            </small>
        </div>
        <button class="btn btn-primary" type="submit">Sign In</button>
    </form>
</div>

<script>
(function() {
    const form = document.getElementById('adminLoginForm');
    if (!form) return;
    const username = document.getElementById('username');
    const password = document.getElementById('password');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');
    const usernameCount = document.getElementById('usernameCount');
    const passwordCount = document.getElementById('passwordCount');
    const submit = form.querySelector('button[type="submit"]');
    const touched = {
        username: false,
        password: false
    };
    let submitted = false;

    function restoreUsername() {
        const storedUser = window.localStorage.getItem('madeit.admin.username');
        if (storedUser && !username.value) {
            username.value = storedUser;
        }
    }

    restoreUsername();

    function validate() {
        const userValue = (username.value || '').trim();
        const passValue = password.value || '';
        username.value = userValue;
        usernameCount.textContent = `${userValue.length}/80`;
        passwordCount.textContent = `${passValue.length}/72`;

        const userValid = userValue.length >= 2;
        const passValid = passValue.length >= 8 && /[A-Za-z]/.test(passValue) && /\d/.test(passValue);

        const showUsernameError = touched.username || submitted;
        const showPasswordError = touched.password || submitted;
        usernameError.textContent = showUsernameError && !userValid ? 'Please enter your username' : '';
        passwordError.textContent = showPasswordError && !passValid ? 'Password must be 8+ characters and include letters and numbers' : '';

        submit.disabled = !(userValid && passValid);
        return userValid && passValid;
    }

    username.addEventListener('input', () => {
        touched.username = true;
        validate();
        window.localStorage.setItem('madeit.admin.username', username.value.trim());
    });
    username.addEventListener('blur', () => {
        touched.username = true;
        validate();
    });
    password.addEventListener('input', () => {
        touched.password = true;
        validate();
    });
    password.addEventListener('blur', () => {
        touched.password = true;
        validate();
    });
    form.addEventListener('submit', function(e) {
        submitted = true;
        if (username.value.trim()) {
            window.localStorage.setItem('madeit.admin.username', username.value.trim());
        }
        if (!validate()) {
            e.preventDefault();
            return;
        }
    });

    window.addEventListener('pageshow', restoreUsername);

    validate();
})();
</script>
