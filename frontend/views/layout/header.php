<?php
$menu_items = get_menu_by_slug('main');
$logo = get_globals_logo();
$has_contact_link = false;
?>

<header data-layout="header">
    <a class="logo-link" href="<?= esc_url(home_url('/')) ?>" aria-label="Zur Startseite">
        <img class="logo" src="<?= esc_url($logo['src']) ?>" alt="<?= esc_attr($logo['alt']) ?>">
    </a>
    <button class="nav-toggle" type="button" aria-controls="main-navigation" aria-expanded="false" aria-label="Menü öffnen">
        <span></span><span></span><span></span>
    </button>
    <nav class="nav-container" id="main-navigation">
        <ul class= "nav">
            <?php foreach ($menu_items as $item): ?>
            <?php $is_about_link = sanitize_title(wp_strip_all_tags($item['title'])) === 'ueber-mich'; ?>
            <?php $is_contact_link = sanitize_title(wp_strip_all_tags($item['title'])) === 'kontakt'; ?>
            <?php if ($is_contact_link) $has_contact_link = true; ?>
            <?php $item_url = $is_about_link
                ? home_url('/#about-me')
                : ($is_contact_link ? home_url('/#contact') : $item['url']); ?>
            <?php $item_target = $is_about_link || $is_contact_link ? '_self' : $item['target']; ?>
            <li class="nav-item">
                <a target="<?= esc_attr($item_target) ?>" href="<?= esc_url($item_url) ?>">
                    <?= esc_html($item['title']) ?>
                </a>
            </li>
            <?php endforeach; ?>
            <?php if (!$has_contact_link): ?>
                <li class="nav-item">
                    <a href="<?= esc_url(home_url('/#contact')) ?>">Kontakt</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
