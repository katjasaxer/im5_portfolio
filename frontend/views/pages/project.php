<?php
$project = get_project_by_id(get_the_ID(), 'page');
?>

<main data-page="project">
    <section class="hero"<?php if (!empty($project['image']['src'])): ?> style="--hero-image: url('<?= esc_url($project['image']['src']) ?>')"<?php endif; ?>>
        <p class="preline">Projekt</p>
        <h1 class="title"><?= esc_html($project['title']) ?></h1>
    </section>

    <?php foreach ($project['sections'] as $section): ?>
        <?php if (!empty($section['category'])): ?>
            <h2 class="category"><?= esc_html($section['category']) ?></h2>
        <?php endif; ?>

    <?php if (!empty($section['gallery'])): ?>
        <div class="gallery">
            <?php foreach ($section['gallery'] as $image): ?>
                <button class="gallery-item" type="button" data-lightbox-src="<?= esc_url($image['src']) ?>" data-lightbox-alt="<?= esc_attr($image['alt']) ?>" aria-label="Bild vergrößern: <?= esc_attr($image['alt']) ?>">
                    <img class="image" src="<?= esc_url($image['src']) ?>" alt="" loading="lazy">
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
