<?php
$data = $args['data'];
$copy = wpautop(wp_kses_post($data['text'] ?? ''));
?>

<section data-module="text" class="<?= !empty($data['compact_spacing']) ? 'text--compact' : '' ?>">
    <?php if (!empty($data['title'])): ?>
        <h2 class="title"><?= esc_html($data['title']) ?></h2>
    <?php endif; ?>
    <?php if (!empty($data['subtitle'])): ?>
        <p class="subtitle"><?= esc_html($data['subtitle']) ?></p>
    <?php endif; ?>
    <div class="copy"><?= $copy ?></div>
</section>
