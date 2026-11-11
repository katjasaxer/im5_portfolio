<?php
$data = $args['data'];
$text_2 = wpautop(wp_kses_post($data['text_2'] ?? ''));
?>

<section id="about-me" data-module="about_me">
    <?php if (!empty($data['image']['src'])): ?>
        <img class="image" src="<?= esc_url($data['image']['src']) ?>" alt="<?= esc_attr($data['image']['alt']) ?>" loading="lazy">
    <?php endif; ?>
    <div class="content">
        <h2 class="title"><?= esc_html($data['title'] ?? '') ?></h2>
        <?php if (!empty($data['subtitle'])): ?>
            <h3 class="subtitle"><?= esc_html($data['subtitle']) ?></h3>
        <?php endif; ?>
        <?php if (!empty($data['text_1'])): ?>
            <p><?= nl2br(esc_html($data['text_1'])) ?></p>
        <?php endif; ?>
        <?php if (!empty($data['text_2'])): ?>
            <div class="copy"><?= $text_2 ?></div>
        <?php endif; ?>
    </div>
</section>

