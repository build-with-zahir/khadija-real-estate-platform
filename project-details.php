<?php
require_once __DIR__ . '/includes/config.php';
$slug = (string)($_GET['slug'] ?? '');
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$project = db_fetch_one(
    'SELECT p.*, a.`AreaName`, a.`City`, c.`Name` AS `CategoryName`
     FROM `project` p
     LEFT JOIN `area` a ON a.`Id` = p.`AreaId`
     LEFT JOIN `category` c ON c.`Id` = p.`CategoryId`
     WHERE p.`Slug` = ? OR p.`Id` = ?
     LIMIT 1',
    'si',
    [$slug, $id]
);
if (!$project) {
    http_response_code(404);
    $pageTitle = 'Project Not Found | Khadija Real Estate';
    require_once __DIR__ . '/includes/header.php';
    render_page_hero('Project Not Found', 'Projects');
    echo '<section class="section-pad"><div class="container text-center muted">Project not found.</div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}
handle_inquiry((int)$project['Id']);
$pageTitle = ($project['ProjectName'] ?? 'Project') . ' | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
$gallery = fetch_project_gallery((int)$project['Id'], $project['ThumbnailImage'] ?? '');
$galleryUrls = array_map(fn($img) => image_url($img), $gallery);
$features = fetch_project_features((int)$project['Id']);
$properties = fetch_properties('pr.`ProjectId` = ? AND pr.`IsActive` = 1', 'i', [(int)$project['Id']], 4);
$testimonials = db_fetch_all('SELECT * FROM `testimonial` WHERE `ProjectId` = ? ORDER BY `CreatedAt` DESC', 'i', [(int)$project['Id']]);
render_page_hero($project['ProjectName'], 'Projects / ' . $project['ProjectName'], $project['ThumbnailImage'] ?? '');
?>
<section class="section-pad">
    <div class="container">
        <?= flash_message() ?>
        <div class="row g-5">
            <div class="col-lg-8 fade-up">
                <?php if ($galleryUrls): ?>
                    <button class="border-0 p-0 w-100 bg-transparent" data-gallery='<?= h(json_encode($galleryUrls)) ?>' data-index="0"><img class="gallery-main" src="<?= h($galleryUrls[0]) ?>" alt="<?= h($project['ProjectName']) ?>"></button>
                    <div class="thumb-grid">
                        <?php foreach (array_slice($galleryUrls, 1, 4) as $i => $image): $index = $i + 1; ?>
                            <button class="thumb" data-gallery='<?= h(json_encode($galleryUrls)) ?>' data-index="<?= $index ?>">
                                <img src="<?= h($image) ?>" alt="Project image">
                                <?php if ($i === 3 && count($galleryUrls) > 5): ?><span class="thumb-more">+<?= count($galleryUrls) - 5 ?></span><?php endif; ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="d-flex flex-wrap gap-2 mt-4">
                    <span class="badge-soft"><?= h($project['CategoryName'] ?? $project['ProjectType'] ?? 'Project') ?></span>
                    <span class="badge-soft"><i class="bi bi-geo-alt me-1"></i><?= h($project['AreaName'] ?? 'Bharuch') ?></span>
                    <span class="badge-gold">Starting <?= h(money($project['StartingPrice'] ?? 0)) ?></span>
                </div>
                <h1 class="display-title display-5 fw-bold mt-4"><?= h($project['ProjectName']) ?></h1>
                <p class="muted lh-lg mt-3"><?= nl2br(h($project['Description'] ?? '')) ?></p>

                <ul class="nav nav-tabs mt-5" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview" type="button">Overview</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#amenities" type="button">Amenities</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#gallery" type="button">Gallery</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#location" type="button">Location</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tours" type="button">House Tours</button></li>
                </ul>
                <div class="tab-content border border-top-0 p-4">
                    <div class="tab-pane fade show active" id="overview"><p class="muted mb-0"><?= nl2br(h($project['Description'] ?? 'Contact us for complete project overview.')) ?></p></div>
                    <div class="tab-pane fade" id="amenities">
                        <div class="row g-3">
                            <?php $items = $features ?: [['FeatureName' => 'Prime location'], ['FeatureName' => 'Quality construction'], ['FeatureName' => 'Dedicated parking'], ['FeatureName' => 'Site visit support']]; ?>
                            <?php foreach ($items as $feature): ?><div class="col-sm-6"><span><i class="bi bi-check-circle text-warning me-2"></i><?= h($feature['FeatureName']) ?></span></div><?php endforeach; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="gallery"><div class="row g-3"><?php foreach ($galleryUrls as $i => $image): ?><div class="col-6 col-md-4"><button class="thumb w-100" data-gallery='<?= h(json_encode($galleryUrls)) ?>' data-index="<?= $i ?>"><img src="<?= h($image) ?>" alt="Gallery"></button></div><?php endforeach; ?></div></div>
                    <div class="tab-pane fade" id="location"><?= $project['GoogleMapLink'] ? '<a class="btn btn-gold" target="_blank" href="' . h($project['GoogleMapLink']) . '">Open Map</a>' : '<p class="muted">Map details will be updated soon.</p>' ?></div>
                    <div class="tab-pane fade" id="tours"><p class="muted mb-0">Schedule a guided project tour with our team.</p></div>
                </div>

                <?php if ($properties): ?>
                    <h2 class="display-title h1 fw-bold mt-5">Available Units</h2>
                    <div class="row g-4 mt-1">
                        <?php foreach ($properties as $property): ?><div class="col-md-6"><?php include __DIR__ . '/includes/property-card.php'; ?></div><?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($testimonials): ?>
                    <h2 class="display-title h1 fw-bold mt-5">Client Reviews</h2>
                    <div class="row g-4 mt-1">
                        <?php foreach ($testimonials as $testimonial): ?>
                            <div class="col-md-6"><div class="p-4 bg-light h-100"><strong><?= h($testimonial['ClientName']) ?></strong><p class="muted mt-2 mb-2"><?= h($testimonial['Review']) ?></p><span class="text-warning"><?= str_repeat('*', max(1, (int)$testimonial['Rating'])) ?></span></div></div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 fade-up">
                <aside class="detail-side">
                    <h3 class="display-title">Project Highlights</h3>
                    <div class="highlight-list my-4">
                        <span><i class="bi bi-geo-alt"></i> <?= h($project['Address'] ?: ($project['AreaName'] ?? 'Bharuch')) ?></span>
                        <span><i class="bi bi-buildings"></i> <?= h($project['ProjectType'] ?: 'Real Estate') ?></span>
                        <span><i class="bi bi-clock"></i> <?= h($project['Status'] ?: 'Ongoing') ?></span>
                        <span><i class="bi bi-cash"></i> <?= h(money($project['StartingPrice'] ?? 0)) ?></span>
                    </div>
                    <h4 class="mt-4">Enquire Now</h4>
                    <?php inquiry_form((int)$project['Id']); ?>
                </aside>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
