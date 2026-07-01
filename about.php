<?php
$pageTitle = 'About Us | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
render_page_hero('About Us', 'About Us');
?>
<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 fade-up">
                <div class="section-label">Our Story</div>
                <h2 class="display-title display-5 fw-bold mt-3">15+ Years of Building Dreams in Bharuch</h2>
                <p class="muted mt-4"><?= h($company['AboutUs'] ?: "Khadija Real Estate has been a trusted name in Bharuch's real estate landscape for over a decade.") ?></p>
                <p class="muted">Our commitment to quality construction, transparent dealings, and timely delivery sets us apart in the real estate market.</p>
                <div class="row g-4 mt-3">
                    <?php foreach ([['200+', 'Projects Completed'], ['5000+', 'Happy Families'], ['15+', 'Years Experience'], ['12+', 'Prime Locations']] as $stat): ?>
                        <div class="col-6"><div class="border-start border-warning border-3 ps-3"><strong class="display-title h2 text-warning d-block"><?= h($stat[0]) ?></strong><small class="fw-bold text-uppercase muted"><?= h($stat[1]) ?></small></div></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-6 fade-up">
                <img class="w-100 object-fit-cover" style="height:460px" src="<?= h(image_url($company['Logo'] ?? '', 'assets/images/hero-fallback.svg')) ?>" alt="About Khadija Real Estate">
            </div>
        </div>
    </div>
</section>
<section class="section-pad section-navy">
    <div class="container">
        <div class="text-center mb-5 fade-up">
            <div class="section-label justify-content-center">Our Values</div>
            <h2 class="display-title display-5 fw-bold mt-3">Vision and Mission</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-6 fade-up"><div class="border border-light border-opacity-10 p-5 h-100"><div class="bg-warning mb-4" style="width:48px;height:4px"></div><h3>Our Vision</h3><p class="text-white-muted">To be the most trusted real estate developer in Gujarat, known for exceptional quality, transparency, and premium living experiences.</p></div></div>
            <div class="col-md-6 fade-up"><div class="border border-light border-opacity-10 p-5 h-100"><div class="bg-warning mb-4" style="width:48px;height:4px"></div><h3>Our Mission</h3><p class="text-white-muted">To build high-quality, affordable, and sustainable residential and commercial properties for modern families and businesses.</p></div></div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
