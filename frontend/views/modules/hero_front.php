<?php
$data = $args['data'];
?>

<section data-module="hero_front"<?php if (!empty($data['image']['src'])): ?> style="--hero-image: url('<?= esc_url($data['image']['src']) ?>')"<?php endif; ?>>
    <div class="hero_front-content">
        <?php if (!empty($data['logo']['src'])): ?>
            <img class="logo" src="<?= esc_url($data['logo']['src']) ?>" alt="<?= esc_attr($data['logo']['alt']) ?>">
        <?php endif; ?>
        <h1 class="title"><?= esc_html($data['title']) ?></h1>
        <?php if (!empty($data['subline'])): ?>
            <p class="subline"><?= esc_html($data['subline']) ?></p>
        <?php endif; ?>
    </div>
</section>

