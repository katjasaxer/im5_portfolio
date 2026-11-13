<?php
$menu = get_menu_by_slug('legals');
$socials = get_globals_socials();
$legal_pages = [
    'datenschutz' => get_page_by_path('datenschutz', OBJECT, 'page'),
    'impressum' => get_page_by_path('impressum', OBJECT, 'page'),
];
?>

<footer data-layout="footer">
    <div class="footer-brand">
        <a class="footer-logo" href="<?= esc_url(home_url('/')) ?>" aria-label="Zur Startseite">
            <img src="<?= esc_url(get_template_directory_uri() . '/frontend/assets/Katja_Logo.png') ?>" alt="Katja Logo">
        </a>
        <nav class="nav-container">
            <ul class="nav">
                <?php foreach ($menu as $item): ?>
                    <?php $legal_slug = sanitize_title(wp_strip_all_tags($item['title'])); ?>
                    <?php $legal_page = $legal_pages[$legal_slug] ?? null; ?>
                    <?php $item_url = $legal_page ? get_permalink($legal_page) : $item['url']; ?>
                    <?php $item_target = $legal_page ? '_self' : $item['target']; ?>
                    <li class="nav-item">
                        <a target="<?= esc_attr($item_target) ?>" href="<?= esc_url($item_url) ?>">
                            <?= esc_html($item['title']) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <div class="socials">
        <?php foreach ($socials as $item): ?>
        <a target="_blank" href="<?= $item['link'] ?>" aria-label="Link zu <?= $item['title'] ?>">
           <img src="<?= $item['icon']['src'] ?>" alt="<?= $item['icon']['alt'] ?>">
          </a>
        <?php endforeach; ?>
    </div>
</footer>
