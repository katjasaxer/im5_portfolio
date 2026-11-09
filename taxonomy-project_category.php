<?php get_header() ?>
<?php get_template_part('frontend/views/layout/header') ?>

<main data-page="project-category">
    <h1 class="title"><?= esc_html(single_term_title('', false)) ?></h1>
    <div class="projects">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php
                $image_id = carbon_get_post_meta(get_the_ID(), 'image');
                $image = $image_id ? get_media_by_id($image_id, 'm') : false;
                ?>
                <article class="project-card">
                    <a href="<?= esc_url(get_permalink()) ?>">
                        <?php if (!empty($image['src'])): ?>
                            <img src="<?= esc_url($image['src']) ?>" alt="<?= esc_attr($image['alt']) ?>" loading="lazy">
                        <?php endif; ?>
                        <h2><?= esc_html(get_the_title()) ?></h2>
                    </a>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p>In dieser Kategorie sind noch keine Projekte vorhanden.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_template_part('frontend/views/layout/footer') ?>
<?php get_footer() ?>
