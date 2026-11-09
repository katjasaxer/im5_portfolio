<?php
$data = $args['data'];
?>

<section data-module="overview_gallery">
    <?php if (!empty($data['items'])): ?>
        <div class="gallery">
            <?php foreach ($data['items'] as $item): ?>
                <?php if (!empty($item['image']['src'])): ?>
                    <?php $category_url = $item['category']['url'] ?? ''; ?>
                    <?php if ($category_url): ?>
                        <a class="gallery-item" href="<?= esc_url($category_url) ?>">
                    <?php else: ?>
                        <div class="gallery-item">
                    <?php endif; ?>
                        <img class="image" src="<?= esc_url($item['image']['src']) ?>" alt="<?= esc_attr($item['image']['alt']) ?>" loading="lazy">
                        <span class="card-copy">
                            <?php if (!empty($item['category']['name'])): ?>
                                <span class="item-category"><?= esc_html($item['category']['name']) ?></span>
                            <?php endif; ?>
                            <h2 class="item-title"><?= esc_html($item['title']) ?></h2>
                        </span>
                    <?php if ($category_url): ?>
                        </a>
                    <?php else: ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

