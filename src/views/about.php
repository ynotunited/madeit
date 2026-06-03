<?php
$stats = [
    ['value' => '3+', 'label' => 'Products in ecosystem'],
    ['value' => 'Problem-first', 'label' => 'Our approach'],
    ['value' => 'Always', 'label' => 'Useful by design'],
];
$aboutImageUrl = 'https://images.pexels.com/photos/36764802/pexels-photo-36764802.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940';
?>

<section class="about-page">
    <section class="ab-story">
        <div class="ab-story-text">
            <h2>MadeIT</h2>
            <p>
                MadeIT was created around a simple belief:
                <em>Software should make life easier, not more complicated.</em>
            </p>
            <p class="ab-story-pull">
                Too many businesses struggle with inefficient processes, disconnected tools, and ideas that never move beyond
                the planning stage. At the same time, many software solutions are either too expensive, too complex, or built
                without truly understanding the people who use them.
            </p>
            <p>
                MadeIT exists to change that. We build practical software products designed to solve real-world business
                challenges, help organizations work more efficiently, and give founders the tools they need to turn ideas
                into reality.
            </p>
        </div>

        <div class="ab-story-visual" aria-label="MadeIT team at work">
            <div class="ab-story-visual-inner">
                <div class="ab-story-visual-image">
                    <img src="/images/about-office.jpg" alt="MadeIT team collaborating in a modern office" class="ab-story-visual-photo">
                </div>
                <div class="ab-visual-badge ab-visual-badge-top">
                    <span>MadeIT Ecosystem</span>
                    <strong>Products that create impact</strong>
                </div>
                <div class="ab-visual-badge ab-visual-badge-bottom">
                    <span class="ab-pill">BuildLedger</span>
                    <span class="ab-pill">SchoolsApp</span>
                    <span class="ab-pill">MadeIT Flow</span>
                </div>
            </div>
        </div>
    </section>

    <section class="ab-section ab-who">
        <div class="ab-section-label">Who We Are</div>
        <div class="ab-two-col">
            <div class="ab-col-main">
                <p>
                    MadeIT is a product-focused technology company that designs, builds, and launches software solutions for
                    businesses, founders, educational institutions, and growing organizations.
                </p>
                <p>
                    Unlike traditional software companies that only build custom projects, we create products that can be used,
                    improved, and scaled across multiple industries.
                </p>
            </div>
            <div class="ab-col-aside">
                <p class="ab-pull-quote">
                    Build software that people genuinely find useful.
                </p>
                <p>
                    Every product within the MadeIT ecosystem is created with one question in mind:
                    <em>"What problem are we solving, and how can we solve it better?"</em>
                </p>
            </div>
        </div>
    </section>

    <section class="ab-watermark-block">
        <div class="ab-watermark-text" aria-hidden="true">WHAT WE DO</div>
        <div class="ab-watermark-content">
            <div class="ab-wm-stats">
                <?php foreach ($stats as $stat): ?>
                <div class="ab-wm-stat">
                    <strong><?= htmlspecialchars($stat['value']) ?></strong>
                    <span><?= htmlspecialchars($stat['label']) ?></span>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="ab-wm-body">
                <p>
                    We develop software products that help businesses operate more effectively, make better decisions, and
                    reduce manual work.
                </p>
                <p class="ab-pull-quote-sm">
                    Technology should not begin with code. It should begin with understanding.
                </p>
                <p>
                    Before creating any solution, we focus on understanding: the problem, the people affected by it,
                    the workflow behind it, and the desired outcome. Only then do we begin designing systems that
                    deliver meaningful results.
                </p>
            </div>
        </div>
    </section>

    <section class="ab-section ab-focus">
        <div class="ab-section-label">Our Focus Areas</div>
        <div class="ab-focus-grid">
            <article class="ab-focus-item">
                <span class="ab-focus-num">01</span>
                <h3>Business Operations</h3>
                <p>Helping organizations manage processes, teams, projects, finances, and day-to-day activities more efficiently.</p>
            </article>
            <article class="ab-focus-item">
                <span class="ab-focus-num">02</span>
                <h3>Education Technology</h3>
                <p>Building tools that simplify administration, communication, and management for schools and educational institutions.</p>
            </article>
            <article class="ab-focus-item">
                <span class="ab-focus-num">03</span>
                <h3>Founder &amp; Startup Tools</h3>
                <p>Creating systems that help entrepreneurs understand, validate, and build software products with greater clarity and confidence.</p>
            </article>
            <article class="ab-focus-item">
                <span class="ab-focus-num">04</span>
                <h3>Workflow Automation</h3>
                <p>Reducing repetitive work through intelligent systems that improve productivity and save valuable time.</p>
            </article>
        </div>
    </section>

    <section class="ab-section ab-diff">
        <div class="ab-section-label">What Makes Us Different</div>
        <div class="ab-diff-grid">
            <article class="ab-diff-item">
                <h3>We Build With Purpose</h3>
                <p>
                    Every product starts with a problem worth solving. We are not interested in creating software for
                    the sake of creating software. We focus on building tools that make measurable improvements to how
                    people work and operate.
                </p>
            </article>
            <article class="ab-diff-item">
                <h3>We Value Simplicity</h3>
                <p>
                    Complexity often creates more problems than it solves. We believe powerful software should remain
                    intuitive, accessible, and easy to use. Our products are designed to reduce friction, not create it.
                </p>
            </article>
            <article class="ab-diff-item">
                <h3>We Think Long-Term</h3>
                <p>
                    Many software projects focus only on launch day. We focus on sustainability. Every product is
                    designed with growth, maintainability, and future improvements in mind.
                </p>
            </article>
            <article class="ab-diff-item">
                <h3>We Focus on Real-World Impact</h3>
                <p>
                    Success is not measured by features alone. Success is measured by the value a product creates for
                    the people who use it. That principle guides every decision we make.
                </p>
            </article>
        </div>
    </section>

    <section class="ab-vision-block">
        <div class="ab-vision-item">
            <div class="ab-vision-label">Our Vision</div>
            <p>
                To build a trusted ecosystem of software products that empower businesses, founders, and organizations
                to operate smarter, grow faster, and achieve more.
            </p>
            <p>
                We envision a future where technology is not a barrier to growth but a catalyst for it — where businesses
                of every size have access to practical, affordable, and effective software solutions.
            </p>
        </div>
        <div class="ab-vision-divider" aria-hidden="true"></div>
        <div class="ab-vision-item">
            <div class="ab-vision-label">Our Mission</div>
            <p>
                To design and deliver software products that solve meaningful problems, improve efficiency, and create
                lasting value for the people and organizations that use them.
            </p>
        </div>
    </section>

    <section class="ab-cta-block">
        <div class="ab-cta-inner">
            <p class="ab-cta-kicker">Looking Ahead</p>
            <h2>Let's Build Better Systems</h2>
            <p>
                Whether you're a founder with a new idea, a business looking for better tools, or an organization
                seeking smarter ways to operate — we're building solutions designed to help you move forward.
            </p>
            <p class="ab-cta-tagline">Welcome to MadeIT. Where ideas become systems, and systems create impact.</p>
            <div class="ab-cta-actions">
                <a href="/flow" class="btn btn-primary">Start Idea Simulation</a>
                <a href="/contact" class="btn btn-outline">Get in Touch</a>
            </div>
        </div>
    </section>
</section>
