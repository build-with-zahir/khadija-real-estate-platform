<?php
require_once __DIR__ . '/includes/config.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
ensure_propertyimage_schema();
$property = fetch_properties('pr.`Id` = ? AND pr.`IsActive` = 1', 'i', [$id], 1)[0] ?? null;
if (!$property) {
    http_response_code(404);
    $pageTitle = 'Property Not Found | Khadija Real Estate';
    require_once __DIR__ . '/includes/header.php';
    render_page_hero('Property Not Found', 'Properties');
    echo '<section class="section-pad"><div class="container text-center muted">Property not found.</div></section>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}
handle_inquiry($property['ProjectId'] ? (int)$property['ProjectId'] : null);
$pageTitle = ($property['Title'] ?? 'Property') . ' | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
$gallery = fetch_property_gallery($property);
$galleryUrls = array_map(fn($img) => image_url($img), $gallery);
$amenities = split_values((string)($property['Amenities'] ?? ''));
render_page_hero($property['Title'], 'Properties / ' . $property['Title'], $gallery[0] ?? '');
?>
<section class="section-pad">
    <div class="container">
        <?= flash_message() ?>
        <div class="row g-5">
            <div class="col-lg-8 fade-up">
                <?php if ($galleryUrls): ?>
                    <button class="border-0 p-0 w-100 bg-transparent" data-gallery='<?= h(json_encode($galleryUrls)) ?>' data-index="0"><img class="gallery-main" src="<?= h($galleryUrls[0]) ?>" alt="<?= h($property['Title']) ?>"></button>
                    <div class="thumb-grid">
                        <?php foreach (array_slice($galleryUrls, 1, 4) as $i => $image): $index = $i + 1; ?>
                            <button class="thumb" data-gallery='<?= h(json_encode($galleryUrls)) ?>' data-index="<?= $index ?>">
                                <img src="<?= h($image) ?>" alt="Property image">
                                <?php if ($i === 3 && count($galleryUrls) > 5): ?><span class="thumb-more">+<?= count($galleryUrls) - 5 ?></span><?php endif; ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <h1 class="display-title display-5 fw-bold mt-5"><?= h($property['Title']) ?></h1>
                <p class="muted"><i class="bi bi-geo-alt text-warning"></i> <?= h($property['Address'] ?: ($property['AreaName'] ?? 'Bharuch')) ?></p>
                <p class="muted lh-lg mt-4"><?= nl2br(h($property['Description'] ?: 'Contact the builder for full property details and site visit availability.')) ?></p>
                <?php if ($amenities): ?>
                    <h2 class="display-title h1 fw-bold mt-5">Amenities</h2>
                    <div class="row g-3 mt-1">
                        <?php foreach ($amenities as $item): ?><div class="col-sm-6"><i class="bi bi-check-circle text-warning me-2"></i><?= h($item) ?></div><?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 fade-up">
                <aside class="detail-side">
                    <p class="text-warning text-uppercase fw-bold small"><?= h($property['Status'] ?? '') ?></p>
                    <p class="display-title h1 text-warning"><?= h(money($property['Price'] ?? 0)) ?></p>
                    <div class="row g-3 my-4 text-white-muted">
                        <div class="col-6"><i class="bi bi-door-open text-warning"></i> <?= (int)$property['Bedrooms'] ?> Beds</div>
                        <div class="col-6"><i class="bi bi-droplet text-warning"></i> <?= (int)$property['Bathrooms'] ?> Baths</div>
                        <div class="col-6"><i class="bi bi-rulers text-warning"></i> <?= (int)$property['SquareFeet'] ?> Sq.ft</div>
                        <div class="col-6"><i class="bi bi-buildings text-warning"></i> <?= h($property['PropertyType'] ?? '') ?></div>
                    </div>
                    <div class="border-top border-light border-opacity-10 pt-4 text-white-muted">
                        <p>Category: <?= h($property['CategoryName'] ?? 'Real Estate') ?></p>
                        <p>Area: <?= h($property['AreaName'] ?? 'Bharuch') ?></p>
                        <?php if (!empty($property['ProjectName'])): ?><p>Project: <?= h($property['ProjectName']) ?></p><?php endif; ?>
                    </div>
                    <h4 class="mt-4">Enquire Now</h4>
                    <?php inquiry_form($property['ProjectId'] ? (int)$property['ProjectId'] : null); ?>
                </aside>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
