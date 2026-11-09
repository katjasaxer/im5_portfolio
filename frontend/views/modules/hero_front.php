<?php
$data = $args['data'];
?>

<section data-module="hero_front"<?php if (!empty($data['image']['src'])): ?> style="--hero-image: url('<?= esc_url($data['image']['src']) ?>')"<?php endif; ?>>
    <div class="hero_front-content">
        <h1 class="title"><?= esc_html($data['title']) ?></h1>
        <?php if (!empty($data['subline'])): ?>
            <p class="subline"><?= esc_html($data['subline']) ?></p>
        <?php endif; ?>
    </div>
</section>

