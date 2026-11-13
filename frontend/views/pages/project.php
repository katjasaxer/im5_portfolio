<?php
$project = get_project_by_id(get_the_ID(), 'page');
?>

<main data-page="project">
    <section class="hero"<?php if (!empty($project['image']['src'])): ?> style="--hero-image: url('<?= esc_url($project['image']['src']) ?>')"<?php endif; ?>>
        <p class="preline">Galerie</p>
        <h1 class="title"><?= esc_html($project['title']) ?></h1>
    </section>

    <?php if (!empty($project['description'])): ?>
        <p class="lead"><?= nl2br(esc_html($project['description'])) ?></p>
    <?php endif; ?>

    <?php $category_sections = array_values(array_filter($project['sections'], static fn($section) => !empty($section['category']))); ?>
    <?php if (count($category_sections) > 1): ?>
        <nav class="gallery-category-nav" aria-label="Galeriekategorien">
            <button class="gallery-category-arrow gallery-category-arrow--left" type="button" aria-label="Nach links scrollen">‹</button>
            <div class="gallery-category-scroll">
                <div class="gallery-category-links">
                    <?php foreach ($category_sections as $index => $section): ?>
                        <?php $category_id = 'gallery-category-' . $index . '-' . sanitize_title($section['category']); ?>
                        <a href="#<?= esc_attr($category_id) ?>"><?= esc_html($section['category']) ?></a>
                    <?php endforeach; ?>
                </div>
                <span class="gallery-category-scrollbar" aria-hidden="true"><span></span></span>
            </div>
            <button class="gallery-category-arrow gallery-category-arrow--right" type="button" aria-label="Nach rechts scrollen">›</button>
        </nav>
    <?php endif; ?>

    <?php foreach ($project['sections'] as $section_index => $section): ?>
        <?php $category_id = !empty($section['category']) ? 'gallery-category-' . count(array_filter(array_slice($project['sections'], 0, $section_index), static fn($previous) => !empty($previous['category']))) . '-' . sanitize_title($section['category']) : ''; ?>
        <?php if (!empty($section['category'])): ?>
            <h2 class="category" id="<?= esc_attr($category_id) ?>"><?= esc_html($section['category']) ?></h2>
        <?php endif; ?>

    <?php if (!empty($section['gallery'])): ?>
        <div class="gallery">
            <?php foreach ($section['gallery'] as $image): ?>
                <button class="gallery-item" type="button" data-lightbox-src="<?= esc_url($image['src']) ?>" data-lightbox-alt="<?= esc_attr($image['alt']) ?>" aria-label="Bild vergrößern: <?= esc_attr($image['alt']) ?>">
                    <img class="image" src="<?= esc_url($image['src']) ?>" alt="" loading="lazy" width="<?= esc_attr($image['width'] ?? '') ?>" height="<?= esc_attr($image['height'] ?? '') ?>">
                    <?php if (!empty($image['year']) || !empty($image['caption'])): ?>
                        <span class="gallery-caption">
                            <?php if (!empty($image['year'])): ?><span class="gallery-year"><?= esc_html($image['year']) ?></span><?php endif; ?>
                            <?php if (!empty($image['caption'])): ?><span class="gallery-description"><?= esc_html($image['caption']) ?></span><?php endif; ?>
                        </span>
                    <?php endif; ?>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <?php endforeach; ?>

    <div class="text">
        <?= wpautop($project['text']) ?>
    </div>

    <dialog class="lightbox" aria-label="Vergrößerte Bildansicht">
        <button class="lightbox-close" type="button" aria-label="Schliessen">&times;</button>
        <img class="lightbox-image" src="" alt="">
    </dialog>
</main>
