<?php
$pageTitle = 'House Tours | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
$projects = fetch_projects('', '', [], 12);
render_page_hero('House Tours', 'House Tours');
?>
<section class="section-pad">
    <div class="container">
        <div class="mb-5 fade-up">
            <div class="section-label">Gallery Tours</div>
            <h2 class="display-title display-5 fw-bold mt-3">Walk Through Our Projects</h2>
            <p class="muted">Explore project visuals and schedule a personal visit for a guided walkthrough.</p>
        </div>
        <div class="row g-4">
            <?php foreach ($projects as $project): $gallery = array_map(fn($img) => image_url($img), fetch_project_gallery((int)$project['Id'], $project['ThumbnailImage'] ?? '')); ?>
                <div class="col-md-6 col-lg-4 fade-up">
                    <article class="project-card card-hover">
                        <button class="media border-0 p-0 w-100" data-gallery='<?= h(json_encode($gallery)) ?>' data-index="0">
                            <img src="<?= h($gallery[0] ?? image_url('')) ?>" alt="<?= h($project['ProjectName']) ?>">
                            <span class="badge-gold position-absolute top-0 start-0 m-3"><i class="bi bi-play-fill"></i> Tour</span>
                        </button>
                        <div class="p-4">
                            <h4><?= h($project['ProjectName']) ?></h4>
                            <p class="muted small"><?= h($project['Address'] ?? $project['AreaName'] ?? '') ?></p>
                            <a class="gold-link" href="<?= h(project_link($project)) ?>">View Project <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
