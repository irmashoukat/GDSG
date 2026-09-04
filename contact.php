<?php
$pageTitle = 'Contact Us';
require __DIR__ . '/includes/functions.php';

$message_sent = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    if ($name && $email && $message) {
        try {
            $message_data = [
                'name' => htmlspecialchars($name),
                'email' => htmlspecialchars($email),
                'subject' => htmlspecialchars($subject),
                'message' => htmlspecialchars($message),
                'timestamp' => date('Y-m-d H:i:s'),
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
            ];
            
            $messages_dir = __DIR__ . '/messages';
            if (!is_dir($messages_dir)) {
                mkdir($messages_dir, 0755, true);
            }
            
            $file_name = $messages_dir . '/' . 'message_' . time() . '_' . uniqid() . '.json';
            file_put_contents($file_name, json_encode($message_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            
            $message_sent = true;
        } catch (Exception $e) {
            $error_message = 'Message saving failed. Please try again later.';
        }
    } else {
        $error_message = 'Please fill in all required fields.';
    }
}

require __DIR__ . '/includes/header.php';
?>

<style>
/* ========================================================
   GDSG CONTACT PAGE STYLING (EXACT DESIGN MATCH)
   ======================================================== */

.contact-page-wrapper {
    background-color: #f8fafc;
    color: #1e293b;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    padding-bottom: 90px;
}

/* ---------------- 1. HERO SECTION ---------------- */
.contact-hero-section {
    position: relative;
    background-color: #001431;
    background-image: url('/assets/images/contact_hero_clean.jpg');
    background-size: cover;
    background-position: center right;
    background-repeat: no-repeat;
    padding: 75px 0 65px;
    color: #ffffff;
    overflow: hidden;
}

.contact-hero-container {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
}

.section-badge-wrap {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}

.hero-badge-tag {
    color: #2dd4bf;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

.hero-badge-line {
    display: inline-block;
    width: 28px;
    height: 2px;
    background: #10b981;
    border-radius: 2px;
}

.contact-hero-title {
    font-size: clamp(2.4rem, 4.5vw, 3.4rem);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    letter-spacing: -0.02em;
    margin: 0 0 16px;
}

.contact-hero-desc {
    color: #cbd5e1;
    font-size: 1.05rem;
    line-height: 1.6;
    max-width: 540px;
    margin: 0;
}

.hero-green-divider {
    width: 42px;
    height: 3px;
    background: #10b981;
    border-radius: 2px;
    margin: 22px 0 30px;
}

/* 3 Action Highlights */
.hero-actions-row {
    display: flex;
    align-items: center;
    gap: 36px;
    flex-wrap: wrap;
}

.hero-action-item {
    display: flex;
    align-items: center;
    gap: 14px;
}

.hero-action-icon {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.hero-action-icon .material-symbols-outlined {
    font-size: 22px;
}

.icon-green {
    background: #ecfdf5;
    color: #059669;
}

.icon-blue {
    background: #eff6ff;
    color: #2563eb;
}

.icon-purple {
    background: #faf5ff;
    color: #9333ea;
}

.hero-action-title {
    font-size: 0.98rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 2px;
}

.hero-action-desc {
    font-size: 0.78rem;
    color: #94a3b8;
    margin: 0;
    line-height: 1.35;
    max-width: 170px;
}

/* ---------------- 2. REACH OUT TO US (CONTACT INFO) ---------------- */
.contact-info-section {
    max-width: 1240px;
    margin: 50px auto 0;
    padding: 0 24px;
}

.content-badge-tag {
    color: #059669;
    font-size: 0.78rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

.content-badge-line {
    display: inline-block;
    width: 28px;
    height: 2px;
    background: #059669;
    border-radius: 2px;
}

.section-title {
    font-size: 2.1rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.02em;
    margin: 0 0 28px;
}

/* 5 Cards Row */
.contact-cards-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr) 260px;
    gap: 20px;
}

@media (max-width: 1200px) {
    .contact-cards-grid {
        grid-template-columns: repeat(2, 1fr) 1fr;
    }
}

@media (max-width: 768px) {
    .contact-cards-grid {
        grid-template-columns: 1fr;
    }
}

.contact-info-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 26px 20px;
    box-shadow: 0 4px 18px -2px rgba(15, 23, 42, 0.04);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
}

.contact-info-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px -4px rgba(15, 23, 42, 0.09);
    border-color: #cbd5e1;
}

.contact-card-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
}

.contact-card-icon-wrap .material-symbols-outlined {
    font-size: 24px;
}

.card-icon-email {
    background: #ecfdf5;
    color: #059669;
}

.card-icon-call {
    background: #eff6ff;
    color: #2563eb;
}

.card-icon-visit {
    background: #faf5ff;
    color: #7c3aed;
}

.card-icon-hours {
    background: #ecfdf5;
    color: #16a34a;
}

.contact-card-heading {
    font-size: 1.12rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 6px;
}

.contact-card-text {
    font-size: 0.84rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0 0 20px;
    flex-grow: 1;
}

.contact-card-link {
    font-size: 0.9rem;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: auto;
}

.link-green {
    color: #059669;
}
.link-green:hover {
    color: #047857;
}

.link-blue {
    color: #2563eb;
}
.link-blue:hover {
    color: #1d4ed8;
}

.link-purple {
    color: #7c3aed;
}
.link-purple:hover {
    color: #6d28d9;
}

.link-emerald {
    color: #16a34a;
}

/* Map Card */
.contact-map-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 4px 18px -2px rgba(15, 23, 42, 0.04);
    display: block;
    position: relative;
    height: 100%;
    min-height: 220px;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    text-decoration: none;
}

.contact-map-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px -4px rgba(15, 23, 42, 0.09);
    border-color: #cbd5e1;
}

.contact-map-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
}

/* ---------------- 3. CONTACT FORM & SIDEBAR ---------------- */
.contact-form-section {
    max-width: 1240px;
    margin: 55px auto 0;
    padding: 0 24px;
    display: grid;
    grid-template-columns: 1fr 370px;
    gap: 32px;
    align-items: start;
}

@media (max-width: 992px) {
    .contact-form-section {
        grid-template-columns: 1fr;
    }
}

/* Form Container Card */
.contact-form-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 34px 32px;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
}

.form-header-title {
    font-size: 1.85rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.02em;
    margin: 0 0 8px;
}

.form-header-subtitle {
    font-size: 0.88rem;
    color: #64748b;
    margin: 0 0 26px;
}

.form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    margin-bottom: 18px;
}

@media (max-width: 600px) {
    .form-grid-2 {
        grid-template-columns: 1fr;
    }
}

.form-group-custom {
    margin-bottom: 18px;
}

.form-label-custom {
    display: block;
    font-size: 0.84rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 6px;
}

.form-label-custom span.req {
    color: #ef4444;
}

.form-input-custom,
.form-textarea-custom {
    width: 100%;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 0.88rem;
    color: #1e293b;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    font-family: inherit;
}

.form-input-custom::placeholder,
.form-textarea-custom::placeholder {
    color: #94a3b8;
}

.form-input-custom:focus,
.form-textarea-custom:focus {
    border-color: #059669;
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12);
}

.contact-submit-btn {
    background: #059669;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    padding: 12px 26px;
    font-size: 0.92rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: background 0.2s ease, transform 0.15s ease;
    box-shadow: 0 2px 8px rgba(5, 150, 105, 0.25);
    margin-top: 6px;
}

.contact-submit-btn:hover {
    background: #047857;
    transform: translateY(-1px);
}

.contact-submit-btn .material-symbols-outlined {
    font-size: 18px;
}

/* ---------------- RIGHT SIDEBAR CARDS ---------------- */
.contact-sidebar {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

/* Card 1: We're Here to Help */
.help-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 30px 28px;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
}

.help-card-title {
    font-size: 1.3rem;
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -0.01em;
    margin: 0 0 10px;
}

.help-card-desc {
    font-size: 0.88rem;
    color: #475569;
    line-height: 1.55;
    margin: 0 0 20px;
}

.help-checklist {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.help-checklist-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.88rem;
    color: #1e293b;
    font-weight: 500;
}

.icon-check {
    color: #059669;
    font-size: 18px;
    flex-shrink: 0;
}

/* Card 2: Follow Us */
.follow-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 28px;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04);
}

.follow-card-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 8px;
}

.follow-card-desc {
    font-size: 0.86rem;
    color: #475569;
    line-height: 1.5;
    margin: 0 0 20px;
}

.social-icons-row {
    display: flex;
    align-items: center;
    gap: 12px;
}

.social-circle-btn {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    text-decoration: none;
    transition: transform 0.2s ease, opacity 0.2s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
}

.social-circle-btn:hover {
    transform: translateY(-2px);
    opacity: 0.92;
    color: #ffffff;
}

.social-btn-linkedin {
    background: #0077b5;
}

.social-btn-x {
    background: #000000;
}

.social-btn-facebook {
    background: #1877f2;
}

.social-btn-youtube {
    background: #ff0000;
}

.social-circle-btn svg {
    display: block;
}

.social-circle-btn:not(.social-btn-youtube) svg {
    width: 17px;
    height: 17px;
    fill: #ffffff;
}

/* Toast */
.contact-toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #0f172a;
    color: #ffffff;
    padding: 14px 22px;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    display: flex;
    align-items: center;
    gap: 10px;
    z-index: 99999;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
    pointer-events: none;
}

.contact-toast.show {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}
</style>

<div class="contact-page-wrapper">
    <!-- 1. HERO SECTION (EXACT MATCH TO MOCKUP) -->
    <section class="contact-hero-section">
        <div class="contact-hero-container">
            <div class="section-badge-wrap">
                <span class="hero-badge-tag">GET IN TOUCH</span>
                <span class="hero-badge-line"></span>
            </div>

            <h1 class="contact-hero-title">
                We'd Love to Hear from You!
            </h1>

            <p class="contact-hero-desc">
                Have a question, collaboration idea, or just want to say hello?<br>
                Reach out to the GDSG team &mdash; we're always happy to connect.
            </p>

            <div class="hero-green-divider"></div>

            <!-- 3 Highlights Row -->
            <div class="hero-actions-row">
                <!-- Collaborate -->
                <div class="hero-action-item">
                    <div class="hero-action-icon icon-green">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <div>
                        <h4 class="hero-action-title">Collaborate</h4>
                        <p class="hero-action-desc">Let's build something impactful together.</p>
                    </div>
                </div>

                <!-- Inquire -->
                <div class="hero-action-item">
                    <div class="hero-action-icon icon-blue">
                        <span class="material-symbols-outlined">lightbulb</span>
                    </div>
                    <div>
                        <h4 class="hero-action-title">Inquire</h4>
                        <p class="hero-action-desc">Ask questions or seek clarifications.</p>
                    </div>
                </div>

                <!-- Connect -->
                <div class="hero-action-item">
                    <div class="hero-action-icon icon-purple">
                        <span class="material-symbols-outlined">near_me</span>
                    </div>
                    <div>
                        <h4 class="hero-action-title">Connect</h4>
                        <p class="hero-action-desc">Join our network and stay updated.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. CONTACT INFORMATION SECTION ("Reach Out to Us") -->
    <section class="contact-info-section">
        <div class="section-badge-wrap">
            <span class="content-badge-tag">CONTACT INFORMATION</span>
            <span class="content-badge-line"></span>
        </div>

        <h2 class="section-title">Reach Out to Us</h2>

        <!-- 5-Card Row -->
        <div class="contact-cards-grid">
            <!-- 1. Email Us -->
            <div class="contact-info-card">
                <div>
                    <div class="contact-card-icon-wrap card-icon-email">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <h3 class="contact-card-heading">Email Us</h3>
                    <p class="contact-card-text">
                        For general inquiries<br>and collaborations.
                    </p>
                </div>
                <a href="mailto:info@gdsg.org" class="contact-card-link link-green">
                    info@gdsg.org
                </a>
            </div>

            <!-- 2. Call Us -->
            <div class="contact-info-card">
                <div>
                    <div class="contact-card-icon-wrap card-icon-call">
                        <span class="material-symbols-outlined">call</span>
                    </div>
                    <h3 class="contact-card-heading">Call Us</h3>
                    <p class="contact-card-text">
                        Mon &ndash; Fri, 9:00 AM &ndash; 6:00 PM<br>(Your local time)
                    </p>
                </div>
                <a href="tel:+15551234567" class="contact-card-link link-blue">
                    +1 (555) 123-4567
                </a>
            </div>

            <!-- 3. Visit Us -->
            <div class="contact-info-card">
                <div>
                    <div class="contact-card-icon-wrap card-icon-visit">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <h3 class="contact-card-heading">Visit Us</h3>
                    <p class="contact-card-text">
                        123 Geospatial Way<br>Geo City, Earth 12345
                    </p>
                </div>
                <a href="https://maps.google.com/?q=Geospatial+Data+Science+Group" target="_blank" rel="noopener noreferrer" class="contact-card-link link-purple">
                    <span>View on Map</span>
                    <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward</span>
                </a>
            </div>

            <!-- 4. Office Hours -->
            <div class="contact-info-card">
                <div>
                    <div class="contact-card-icon-wrap card-icon-hours">
                        <span class="material-symbols-outlined">schedule</span>
                    </div>
                    <h3 class="contact-card-heading">Office Hours</h3>
                    <p class="contact-card-text">
                        Mon &ndash; Fri<br>9:00 AM &ndash; 6:00 PM
                    </p>
                </div>
                <span class="contact-card-link link-emerald">
                    (UTC -5)
                </span>
            </div>

            <!-- 5. Map Card -->
            <a href="https://maps.google.com/?q=Geospatial+Data+Science+Group" target="_blank" rel="noopener noreferrer" class="contact-map-card" title="Click to view on Google Maps">
                <img src="/assets/images/contact_map_preview.png" alt="Geospatial Data Science Group Location Map" class="contact-map-img">
            </a>
        </div>
    </section>

    <!-- 3. CONTACT FORM & HELP SIDEBAR -->
    <section class="contact-form-section">
        <!-- Form Column -->
        <div class="contact-form-card">
            <div class="section-badge-wrap">
                <span class="content-badge-tag">SEND US A MESSAGE</span>
                <span class="content-badge-line"></span>
            </div>

            <h2 class="form-header-title">Contact Form</h2>
            <p class="form-header-subtitle">
                Fill out the form below and our team will get back to you as soon as possible.
            </p>

            <?php if ($message_sent): ?>
                <div class="alert alert-success d-flex align-items-center gap-2 rounded-3 mb-4" role="alert">
                    <span class="material-symbols-outlined text-success">check_circle</span>
                    <div><strong>Thank you!</strong> Your message has been sent successfully. We will get back to you shortly.</div>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="alert alert-danger d-flex align-items-center gap-2 rounded-3 mb-4" role="alert">
                    <span class="material-symbols-outlined text-danger">error</span>
                    <div><strong>Error:</strong> <?php echo htmlspecialchars($error_message); ?></div>
                </div>
            <?php endif; ?>

            <form method="post" action="contact.php" id="gdsgContactForm">
                <div class="form-grid-2">
                    <div>
                        <label class="form-label-custom" for="contactName">Your Name <span class="req">*</span></label>
                        <input type="text" 
                               id="contactName" 
                               name="name" 
                               class="form-input-custom" 
                               placeholder="Enter your full name" 
                               required 
                               value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    <div>
                        <label class="form-label-custom" for="contactEmail">Your Email <span class="req">*</span></label>
                        <input type="email" 
                               id="contactEmail" 
                               name="email" 
                               class="form-input-custom" 
                               placeholder="Enter your email" 
                               required 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom" for="contactSubject">Subject <span class="req">*</span></label>
                    <input type="text" 
                           id="contactSubject" 
                           name="subject" 
                           class="form-input-custom" 
                           placeholder="Enter the subject" 
                           required 
                           value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                </div>

                <div class="form-group-custom">
                    <label class="form-label-custom" for="contactMessage">Message <span class="req">*</span></label>
                    <textarea id="contactMessage" 
                              name="message" 
                              rows="5" 
                              class="form-textarea-custom" 
                              placeholder="Write your message here..." 
                              required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                </div>

                <button type="submit" class="contact-submit-btn">
                    <span>Send Message</span>
                    <span class="material-symbols-outlined">send</span>
                </button>
            </form>
        </div>

        <!-- Right Sidebar Stack -->
        <aside class="contact-sidebar">
            <!-- Card 1: We're Here to Help -->
            <div class="help-card">
                <h3 class="help-card-title">We're Here to Help</h3>
                <p class="help-card-desc">
                    Whether you're a researcher, student, partner, or organization &mdash; we're excited to connect and explore possibilities with you.
                </p>

                <ul class="help-checklist">
                    <li class="help-checklist-item">
                        <span class="material-symbols-outlined icon-check">check_circle</span>
                        <span>Research Collaborations</span>
                    </li>
                    <li class="help-checklist-item">
                        <span class="material-symbols-outlined icon-check">check_circle</span>
                        <span>Project Partnerships</span>
                    </li>
                    <li class="help-checklist-item">
                        <span class="material-symbols-outlined icon-check">check_circle</span>
                        <span>Internships &amp; Opportunities</span>
                    </li>
                    <li class="help-checklist-item">
                        <span class="material-symbols-outlined icon-check">check_circle</span>
                        <span>General Inquiries</span>
                    </li>
                </ul>
            </div>

            <!-- Card 2: Follow Us -->
            <div class="follow-card">
                <h3 class="follow-card-title">Follow Us</h3>
                <p class="follow-card-desc">
                    Stay connected with us on social media for the latest updates.
                </p>

                <div class="social-icons-row">
                    <!-- LinkedIn -->
                    <a href="https://www.linkedin.com/company/geospatial-data-science-group/about/?viewAsMember=true" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="social-circle-btn social-btn-linkedin" 
                       aria-label="LinkedIn"
                       title="Follow GDSG on LinkedIn">
                        <svg viewBox="0 0 24 24"><path d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.46 10.9v8.37H9.2V10.9H6.46M7.83 6.45a1.6 1.6 0 0 0-1.6 1.6 1.6 1.6 0 0 0 1.6 1.6 1.6 1.6 0 0 0 1.6-1.6c0-.88-.72-1.6-1.6-1.6Z"/></svg>
                    </a>

                    <!-- X (Twitter) -->
                    <a href="https://x.com" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="social-circle-btn social-btn-x" 
                       aria-label="X"
                       title="Follow GDSG on X">
                        <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/profile.php?viewas=100000686899395&id=61567873319375" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="social-circle-btn social-btn-facebook" 
                       aria-label="Facebook"
                       title="Follow GDSG on Facebook">
                        <svg viewBox="0 0 24 24"><path d="M12 2.04c-5.5 0-10 4.49-10 10.02 0 5 3.66 9.15 8.44 9.9v-7H7.9v-2.9h2.54V9.85c0-2.51 1.49-3.89 3.78-3.89 1.09 0 2.23.19 2.23.19v2.47h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.45 2.9h-2.33v7a10 10 0 0 0 8.44-9.9c0-5.53-4.5-10.02-10-10.02Z"/></svg>
                    </a>

                    <!-- YouTube -->
                    <a href="https://youtube.com" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="social-circle-btn social-btn-youtube" 
                       aria-label="YouTube"
                       title="Subscribe to GDSG on YouTube">
                        <svg viewBox="0 0 24 24" width="22" height="22">
                            <path fill="#ffffff" d="M21.58 7.19c-.23-.86-.91-1.54-1.77-1.77C18.25 5 12 5 12 5s-6.25 0-7.81.42c-.86.23-1.54.91-1.77 1.77C2 8.75 2 12 2 12s0 3.25.42 4.81c.23.86.91 1.54 1.77 1.77C5.75 19 12 19 12 19s6.25 0 7.81-.42c.86-.23 1.54-.91 1.77-1.77C22 15.25 22 12 22 12s0-3.25-.42-4.81z"/>
                            <polygon fill="#ff0000" points="10,15 15.5,12 10,9"/>
                        </svg>
                    </a>
                </div>
            </div>
        </aside>
    </section>
</div>

<!-- Toast Notification on Success -->
<?php if ($message_sent): ?>
<div id="contactSuccessToast" class="contact-toast show">
    <span class="material-symbols-outlined" style="color: #10b981;">check_circle</span>
    <span>Thank you! Your message has been sent successfully.</span>
</div>
<script>
setTimeout(function() {
    const toast = document.getElementById('contactSuccessToast');
    if (toast) toast.classList.remove('show');
}, 4500);
</script>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
