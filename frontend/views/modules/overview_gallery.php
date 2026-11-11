<?php
$data = $args['data'];
?>

<section data-module="overview_gallery">
    <?php if (!empty($data['gallery_title'])): ?>
        <h1 class="gallery-title"><?= esc_html($data['gallery_title']) ?></h1>
    <?php endif; ?>
    <?php if (!empty($data['items'])): ?>
        <div class="gallery">
            <?php foreach ($data['items'] as $item): ?>
                <?php if (!empty($item['image']['src'])): ?>
                    <?php $project_url = $item['project']['url'] ?? ''; ?>
                    <?php if ($project_url): ?>
                        <a class="gallery-item" href="<?= esc_url($project_url) ?>">
                    <?php else: ?>
                        <div class="gallery-item">
                    <?php endif; ?>
                        <img class="image" src="<?= esc_url($item['image']['src']) ?>" alt="<?= esc_attr($item['image']['alt']) ?>" loading="lazy">
                        <span class="card-copy">
                            <?php if (!empty($item['project']['name'])): ?>
                                <span class="item-project"><?= esc_html($item['project']['name']) ?></span>
                            <?php endif; ?>
                            <h2 class="item-title"><?= esc_html($item['title']) ?></h2>
                        </span>
                    <?php if ($project_url): ?>
                        </a>
                    <?php else: ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

