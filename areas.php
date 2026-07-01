<?php
$pageTitle = 'Areas | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
$areas = db_fetch_all('SELECT * FROM `area` ORDER BY `Id` DESC');
render_page_hero('Project Areas', 'Areas');
?>
<section class="section-pad">
    <div class="container">
        <div class="mb-5 fade-up">
            <div class="section-label">Prime Locations</div>
            <h2 class="display-title display-5 fw-bold mt-3">Explore Areas Across Bharuch</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($areas as $area): ?>
                <div class="col-md-6 col-lg-4 fade-up">
                    <a class="area-card card-hover d-block" href="<?= h(site_url('projects.php?area=' . (int)$area['Id'])) ?>">
                        <div class="media"><img src="<?= h(image_url($area['ImageUrl'] ?? '')) ?>" alt="<?= h($area['AreaName'] ?? '') ?>"><span class="badge-gold position-absolute top-0 start-0 m-3"><?= h($area['City'] ?? 'Bharuch') ?></span></div>
                        <div class="p-4">
                            <h3><?= h($area['AreaName'] ?? '') ?></h3>
                            <p class="muted"><?= h($area['Description'] ?? 'Premium project area with residential and construction opportunities.') ?></p>
                            <span class="gold-link">View Projects <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
