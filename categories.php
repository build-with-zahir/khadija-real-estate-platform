<?php
$pageTitle = 'Categories | Khadija Real Estate';
require_once __DIR__ . '/includes/header.php';
$categories = db_fetch_all('SELECT * FROM `category` ORDER BY `Id` DESC');
render_page_hero('Our Categories', 'Categories');
?>
<section class="section-pad">
    <div class="container">
        <div class="mb-5 fade-up">
            <div class="section-label">Expertise</div>
            <h2 class="display-title display-5 fw-bold mt-3">What We Specialize In</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-6 col-lg-4 fade-up">
                    <article class="project-card card-hover">
                        <div class="media"><img src="<?= h(image_url($category['ImageUrl'] ?? '')) ?>" alt="<?= h($category['Name'] ?? '') ?>"></div>
                        <div class="p-4">
                            <i class="bi bi-buildings fs-2 text-warning"></i>
                            <h3 class="mt-3"><?= h($category['Name'] ?? '') ?></h3>
                            <p class="muted"><?= h($category['Description'] ?? 'Explore builder work, construction quality, active projects, and completed landmarks in this category.') ?></p>
                            <a class="gold-link" href="<?= h(site_url('projects.php?category=' . (int)$category['Id'])) ?>">View Projects <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
