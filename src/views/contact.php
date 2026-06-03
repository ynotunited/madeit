<div class="contact-page">
    <section class="contact-shell">
        <div class="contact-intro">
            <div class="contact-badge">Start a product</div>
            <h1>Let’s build your next digital product</h1>
            <p>
                Reach out to our team to start a conversation about your business, product idea, or support need.
                We’ll help you move from idea to launch with clarity.
            </p>

            <div class="contact-points">
                <div class="contact-point">
                    <span class="contact-point-label">Email</span>
                    <a href="mailto:hello@madeitcodes.online">hello@madeitcodes.online</a>
                </div>
                <div class="contact-point">
                    <span class="contact-point-label">Location</span>
                    <span>Lagos, Nigeria</span>
                </div>
                <div class="contact-point">
                    <span class="contact-point-label">Response</span>
                    <span>Usually within 1 business day</span>
                </div>
            </div>

            <div class="contact-mini-links">
                <a href="/products">See products</a>
                <a href="/flow">Try idea simulation</a>
            </div>
        </div>

        <div class="contact-form-card">
            <div class="contact-form-head">
                <div>
                    <div class="contact-form-kicker">Contact form</div>
                    <h2>Tell us about what you want to build</h2>
                </div>
                <p>Use the form below and we’ll get back to you with next steps.</p>
            </div>

            <?php if (!empty($_GET['sent'])): ?>
                <div class="contact-flash success">Thanks, your message has been sent. We’ll get back to you soon.</div>
            <?php endif; ?>

            <form action="/api/contact" method="POST" id="contactForm" class="contact-form" novalidate>
                <input type="hidden" name="source" value="contact_form">

                <div class="field-grid">
                    <div class="field-group">
                        <label for="name">Your name</label>
                        <input type="text" id="name" name="name" required maxlength="80" autocomplete="name" placeholder="John Doe">
                        <div class="field-meta">
                            <small class="field-error" id="nameError"></small>
                            <small class="field-count" id="nameCount">0/80</small>
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="email">Your email</label>
                        <input type="email" id="email" name="email" required maxlength="255" autocomplete="email" placeholder="hello@company.com">
                        <div class="field-meta">
                            <small class="field-error" id="emailError"></small>
                            <small class="field-count" id="emailCount">0/255</small>
                        </div>
                    </div>
                </div>

                <div class="field-group">
                    <label for="category">Services</label>
                    <select id="category" name="category">
                        <option value="build">Build a product</option>
                        <option value="support">SaaS support</option>
                        <option value="partnership">Partnership</option>
                        <option value="general">General inquiry</option>
                    </select>
                </div>

                <div class="field-group">
                    <label for="message">Tell us a bit about your product</label>
                    <textarea id="message" name="message" rows="6" required maxlength="1000" placeholder="What are you trying to build or improve?"></textarea>
                    <div class="field-meta">
                        <small class="field-error" id="messageError"></small>
                        <small class="field-count" id="messageCount">0/1000</small>
                    </div>
                </div>

                <button type="submit" class="contact-submit" id="contactSubmit" disabled>Send Message</button>
            </form>
        </div>
    </section>
</div>

<script>
(function() {
    const form = document.getElementById('contactForm');
    if (!form) return;

    const fields = {
        name: document.getElementById('name'),
        email: document.getElementById('email'),
        message: document.getElementById('message')
    };
    const errors = {
        name: document.getElementById('nameError'),
        email: document.getElementById('emailError'),
        message: document.getElementById('messageError')
    };
    const counts = {
        name: document.getElementById('nameCount'),
        email: document.getElementById('emailCount'),
        message: document.getElementById('messageCount')
    };
    const submit = document.getElementById('contactSubmit');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const touched = {
        name: false,
        email: false,
        message: false
    };
    let submitted = false;

    function normalize(value) {
        return String(value || '').trim().replace(/\s+/g, ' ');
    }

    function validateField(fieldName, valid, message) {
        const showError = touched[fieldName] || submitted;
        errors[fieldName].textContent = showError ? message : '';
        fields[fieldName].setAttribute('aria-invalid', valid ? 'false' : 'true');
    }

    function update() {
        const name = normalize(fields.name.value);
        const email = normalize(fields.email.value);
        const message = normalize(fields.message.value);

        fields.name.value = name;
        fields.email.value = email;
        fields.message.value = message;

        counts.name.textContent = `${name.length}/80`;
        counts.email.textContent = `${email.length}/255`;
        counts.message.textContent = `${message.length}/1000`;

        const nameValid = name.length >= 2;
        const emailValid = emailRegex.test(email);
        const messageValid = message.length >= 10;

        validateField('name', nameValid, nameValid ? '' : 'Please enter your name');
        validateField('email', emailValid, emailValid ? '' : 'Please enter a valid email address');
        validateField('message', messageValid, messageValid ? '' : 'Message should be at least 10 characters');

        submit.disabled = !(nameValid && emailValid && messageValid);
        return nameValid && emailValid && messageValid;
    }

    Object.values(fields).forEach((field) => {
        const saved = window.localStorage.getItem(`madeit.contact.${field.name}`);
        if (saved && !field.value) field.value = saved;
        field.addEventListener('input', () => {
            touched[field.name] = true;
            window.localStorage.setItem(`madeit.contact.${field.name}`, normalize(field.value));
            update();
        });
        field.addEventListener('blur', () => {
            touched[field.name] = true;
            update();
        });
    });

    update();

    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        submitted = true;
        if (!update()) return;

        submit.disabled = true;
        submit.textContent = 'Sending...';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: new URLSearchParams(new FormData(form))
            });

            const data = await response.json().catch(() => ({}));
            if (!response.ok || !data.success) throw new Error(data.message || 'Unable to send your message');

            submit.textContent = 'Sent';
            submit.disabled = true;
        } catch (err) {
            submit.textContent = 'Send Message';
            submit.disabled = false;
            alert(err.message || 'Unable to send your message');
        }
    });
})();
</script>
