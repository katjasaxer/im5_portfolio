<?php
$data = $args['data'];
?>

<section id="about-me" data-module="about_me">
    <?php if (!empty($data['image']['src'])): ?>
        <img class="image" src="<?= esc_url($data['image']['src']) ?>" alt="<?= esc_attr($data['image']['alt']) ?>" loading="lazy">
    <?php endif; ?>
    <div class="content">
        <h2 class="title"><?= esc_html($data['title'] ?? '') ?></h2>
        <?php if (!empty($data['text_1'])): ?>
            <p><?= nl2br(esc_html($data['text_1'])) ?></p>
        <?php endif; ?>
        <?php if (!empty($data['text_2'])): ?>
            <p><?= nl2br(esc_html($data['text_2'])) ?></p>
        <?php endif; ?>
    </div>
</section>

