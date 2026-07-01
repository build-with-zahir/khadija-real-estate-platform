<?php
$pageTitle = 'Properties | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
ensure_propertyimage_schema();
$filter = strtolower((string)($_GET['filter'] ?? 'all'));
$projectId = isset($_GET['project']) ? (int)$_GET['project'] : 0;
$where = ['pr.`IsActive` = 1'];
$types = '';
$params = [];
if ($filter === '3bhk') {
    $where[] = 'pr.`Bedrooms` = 3';
} elseif ($filter === '4bhk') {
    $where[] = 'pr.`Bedrooms` = 4';
} elseif ($filter === 'penthouse') {
    $where[] = 'LOWER(pr.`PropertyType`) LIKE ?';
    $types .= 's';
    $params[] = '%penthouse%';
}
if ($projectId > 0) {
    $where[] = 'pr.`ProjectId` = ?';
    $types .= 'i';
    $params[] = $projectId;
}
$properties = fetch_properties(implode(' AND ', $where), $types, $params);
render_page_hero('Properties', 'Properties');
?>
<section class="section-pad">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5 fade-up">
            <div>
                <div class="section-label">Available Units</div>
                <h2 class="display-title display-5 fw-bold mt-3">Browse Properties</h2>
            </div>
            <div class="filter-bar">
                <?php foreach (['all' => 'All', '3bhk' => '3BHK', '4bhk' => '4BHK', 'penthouse' => 'Penthouse'] as $key => $label): ?>
                    <a class="<?= $filter === $key ? 'active' : '' ?>" href="<?= h(site_url('properties.php?filter=' . $key . ($projectId ? '&project=' . $projectId : ''))) ?>"><?= h($label) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($properties as $property): ?><div class="col-md-6 col-lg-4 fade-up"><?php include __DIR__ . '/includes/property-card.php'; ?></div><?php endforeach; ?>
        </div>
        <?php if (!$properties): ?><div class="text-center py-5 muted">No properties found.</div><?php endif; ?>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
