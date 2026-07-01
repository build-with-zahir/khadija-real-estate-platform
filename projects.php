<?php
$pageTitle = 'Projects | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';

$where = [];
$types = '';
$params = [];
$filter = strtolower((string)($_GET['filter'] ?? 'all'));
$categoryId = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$areaId = isset($_GET['area']) ? (int)$_GET['area'] : 0;

if ($filter !== 'all' && $filter !== '') {
    if (in_array($filter, ['ongoing', 'upcoming', 'completed'], true)) {
        $where[] = 'LOWER(p.`Status`) = ?';
        $types .= 's';
        $params[] = $filter;
    } else {
        $where[] = '(LOWER(p.`ProjectType`) = ? OR LOWER(c.`Name`) = ?)';
        $types .= 'ss';
        $params[] = $filter;
        $params[] = $filter;
    }
}
if ($categoryId > 0) {
    $where[] = 'p.`CategoryId` = ?';
    $types .= 'i';
    $params[] = $categoryId;
}
if ($areaId > 0) {
    $where[] = 'p.`AreaId` = ?';
    $types .= 'i';
    $params[] = $areaId;
}
$projects = fetch_projects(implode(' AND ', $where), $types, $params);
render_page_hero('Our Projects', 'Projects');
?>
<section class="section-pad">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-5 fade-up">
            <div>
                <div class="section-label">Dynamic Portfolio</div>
                <h2 class="display-title display-5 fw-bold mt-3">Browse Projects By Type and Status</h2>
            </div>
            <div class="filter-bar">
                <?php foreach (['all' => 'All', 'residential' => 'Residential', 'commercial' => 'Commercial', 'ongoing' => 'Ongoing', 'completed' => 'Completed'] as $key => $label): ?>
                    <a class="<?= $filter === $key || ($filter === '' && $key === 'all') ? 'active' : '' ?>" href="<?= h(site_url('projects.php?filter=' . $key)) ?>"><?= h($label) ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($projects as $project): ?>
                <div class="col-md-6 col-lg-4 fade-up"><?php include __DIR__ . '/includes/project-card.php'; ?></div>
            <?php endforeach; ?>
        </div>
        <?php if (!$projects): ?><div class="text-center py-5 muted">No projects found.</div><?php endif; ?>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
