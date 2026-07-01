<?php
require_once __DIR__ . '/includes/config.php';
handle_inquiry(null);
$pageTitle = 'Contact | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
render_page_hero('Contact Us', 'Contact');
?>
<section class="section-pad">
    <div class="container">
        <?= flash_message() ?>
        <div class="row g-5">
            <div class="col-lg-5 fade-up">
                <div class="section-label">Reach Us</div>
                <h2 class="display-title display-5 fw-bold mt-3">Let Us Help You Find The Right Property</h2>
                <div class="mt-4 d-grid gap-3">
                    <div class="d-flex gap-3 bg-white shadow-sm p-4"><i class="bi bi-geo-alt fs-4 text-warning"></i><div><small class="fw-bold text-uppercase muted">Our Office</small><p class="mb-0 fw-bold"><?= h($company['Address'] ?: "BG Trader's Pachbatti") ?></p></div></div>
                    <div class="d-flex gap-3 bg-white shadow-sm p-4"><i class="bi bi-telephone fs-4 text-warning"></i><div><small class="fw-bold text-uppercase muted">Call Us</small><p class="mb-0 fw-bold"><?= h($company['Phone'] ?: '99980 85007') ?></p></div></div>
                    <div class="d-flex gap-3 bg-white shadow-sm p-4"><i class="bi bi-envelope fs-4 text-warning"></i><div><small class="fw-bold text-uppercase muted">Email Us</small><p class="mb-0 fw-bold"><?= h($company['Email'] ?: 'info@khadijarealestate.com') ?></p></div></div>
                </div>
                <div class="section-navy p-4 mt-4">
                    <small class="text-warning fw-bold text-uppercase">Working Hours</small>
                    <h4 class="display-title mt-2">Monday - Saturday</h4>
                    <p class="text-white-muted mb-0">9:00 AM - 7:00 PM. Sunday by appointment only.</p>
                </div>
            </div>
            <div class="col-lg-7 fade-up">
                <div class="bg-light p-4 p-lg-5">
                    <h3 class="display-title h1 fw-bold">Send Inquiry</h3>
                    <p class="muted">Share your requirement and our team will call you back.</p>
                    <?php inquiry_form(null); ?>
                </div>
                <?php if (!empty($company['GoogleMapEmbed'])): ?>
                    <div class="ratio ratio-16x9 mt-4"><?= $company['GoogleMapEmbed'] ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
