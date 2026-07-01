<?php
$pageTitle = 'Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';

$projects = fetch_projects('', '', [], 6);
$categories = db_fetch_all('SELECT * FROM `category` ORDER BY `Id` DESC LIMIT 3');
$areas = db_fetch_all('SELECT * FROM `area` ORDER BY `Id` DESC LIMIT 4');
$properties = fetch_properties('pr.`IsActive` = 1 AND pr.`IsFeatured` = 1', '', [], 3);
$hero = $projects[0]['ThumbnailImage'] ?? '';
?>
<section class="hero">
    <div class="hero-bg" style="background-image:url('<?= h(image_url($hero, 'assets/images/hero-fallback.svg')) ?>')"></div>
    <div class="container hero-content">
        <div class="fade-up in-view">
            <div class="section-label">Building Trust. Creating Landmarks.</div>
            <h1>We Build More Than Structures, <span class="text-gold-gradient">We Build Trust.</span></h1>
            <p class="lead mt-4">From residential societies to commercial spaces and quality construction, Khadija Real Estate presents completed work, ongoing projects, and premium properties.</p>
            <div class="d-flex flex-wrap gap-3 mt-5">
                <a class="btn btn-gold" href="<?= h(site_url('projects.php')) ?>">Explore Projects <i class="bi bi-arrow-right"></i></a>
                <a class="btn btn-outline-light rounded-0 px-4 py-3 text-uppercase fw-bold" href="<?= h(site_url('categories.php')) ?>">Our Categories</a>
            </div>
        </div>
    </div>
</section>

<section class="stats-band">
    <div class="container">
        <div class="row g-0">
            <?php foreach ([['200+', 'Projects Completed'], ['15+', 'Years Experience'], ['5000+', 'Happy Families'], ['12+', 'Prime Locations']] as $stat): ?>
                <div class="col-6 col-lg-3 stat-box"><strong><?= h($stat[0]) ?></strong><span><?= h($stat[1]) ?></span></div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5 fade-up">
            <div>
                <div class="section-label">What We Do</div>
                <h2 class="display-title display-5 fw-bold mt-3">Our Expertise and Categories</h2>
            </div>
            <a class="btn btn-outline-gold" href="<?= h(site_url('categories.php')) ?>">All Categories <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-4 fade-up">
                    <a class="image-card d-block" href="<?= h(site_url('projects.php?category=' . (int)$category['Id'])) ?>">
                        <img src="<?= h(image_url($category['ImageUrl'] ?? '')) ?>" alt="<?= h($category['Name'] ?? '') ?>">
                        <span class="corner"></span>
                        <span class="image-card-content">
                            <i class="bi bi-buildings fs-2 text-warning"></i>
                            <h3 class="mt-3"><?= h($category['Name'] ?? '') ?></h3>
                            <span class="gold-link text-warning">Explore <i class="bi bi-arrow-right"></i></span>
                        </span>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-pad section-cream">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5 fade-up">
            <div>
                <div class="section-label">Signature Projects</div>
                <h2 class="display-title display-5 fw-bold mt-3">Our Landmark Developments</h2>
            </div>
            <a class="btn btn-outline-gold" href="<?= h(site_url('projects.php')) ?>">All Projects <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            <?php foreach ($projects as $project): ?>
                <div class="col-md-6 col-lg-4 fade-up">
                    <?php include __DIR__ . '/includes/project-card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-pad section-navy">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5 fade-up">
                <div class="section-label">Why Choose Us</div>
                <h2 class="display-title display-5 fw-bold mt-3">Building Excellence With Every Project</h2>
                <p class="text-white-muted mt-4">We focus on durable materials, planned layouts, transparent communication, and practical delivery timelines for families and investors alike.</p>
                <a class="btn btn-outline-gold mt-3 text-warning" href="<?= h(site_url('about.php')) ?>">Learn More</a>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <?php foreach ([['bi-hammer', 'Quality Construction', 'Premium materials, expert craftsmanship, and strict standards.'], ['bi-clock', 'Timely Delivery', 'Clear commitments and practical delivery timelines.'], ['bi-shield-check', 'Transparent Deals', 'No hidden costs or surprises from agreement to possession.'], ['bi-graph-up-arrow', 'Modern Growth', 'Strategic locations with long-term value.']] as $reason): ?>
                        <div class="col-sm-6 fade-up">
                            <div class="border border-light border-opacity-10 p-4 h-100 card-hover">
                                <span class="d-inline-grid place-items-center bg-warning bg-opacity-10 text-warning p-3 mb-3"><i class="bi <?= h($reason[0]) ?>"></i></span>
                                <h5><?= h($reason[1]) ?></h5>
                                <p class="text-white-muted mb-0"><?= h($reason[2]) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5 fade-up">
            <div>
                <div class="section-label">Prime Locations</div>
                <h2 class="display-title display-5 fw-bold mt-3">Projects By Area</h2>
            </div>
            <a class="btn btn-outline-gold" href="<?= h(site_url('areas.php')) ?>">All Areas <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            <?php foreach ($areas as $area): ?>
                <div class="col-md-6 col-lg-3 fade-up">
                    <a class="area-card card-hover d-block" href="<?= h(site_url('projects.php?area=' . (int)$area['Id'])) ?>">
                        <div class="media"><img src="<?= h(image_url($area['ImageUrl'] ?? '')) ?>" alt="<?= h($area['AreaName'] ?? '') ?>"></div>
                        <div class="p-4">
                            <span class="badge-soft mb-3"><?= h($area['City'] ?? 'Bharuch') ?></span>
                            <h4><?= h($area['AreaName'] ?? '') ?></h4>
                            <p class="muted small mb-0"><?= h($area['Description'] ?? '') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-pad section-navy">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5 fade-up">
            <div>
                <div class="section-label">Available Homes</div>
                <h2 class="display-title display-5 fw-bold mt-3">Featured Properties</h2>
            </div>
            <a class="btn btn-outline-gold text-warning" href="<?= h(site_url('properties.php')) ?>">All Properties <i class="bi bi-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            <?php foreach ($properties as $property): ?>
                <div class="col-md-6 col-lg-4 fade-up">
                    <?php include __DIR__ . '/includes/property-card.php'; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-pad">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 fade-up">
                <div class="section-label">Why Visit Us</div>
                <h2 class="display-title display-5 fw-bold mt-3">Experience Our Projects In Person</h2>
                <p class="muted mt-4">Walk through completed projects, explore floor plans, and meet our team for personal guidance through every stage of your property journey.</p>
                <div class="highlight-list mt-4">
                    <span><i class="bi bi-check-circle"></i> Personal site visit arrangements</span>
                    <span><i class="bi bi-check-circle"></i> Transparent pricing and documentation</span>
                    <span><i class="bi bi-check-circle"></i> Legal and financial assistance</span>
                    <span><i class="bi bi-check-circle"></i> Post-possession support</span>
                </div>
            </div>
            <div class="col-lg-6 fade-up">
                <div class="p-5 section-navy">
                    <h3 class="display-title">Ready to visit?</h3>
                    <p class="text-white-muted">Call now for pricing, site visit and availability.</p>
                    <p class="h3 text-warning"><?= h($company['Phone'] ?: '99980 85007') ?></p>
                    <a class="btn btn-gold mt-3" href="<?= h(site_url('contact.php')) ?>">Book A Visit</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
