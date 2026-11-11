<?php
$menu = get_menu_by_slug('legals');
$logo = get_globals_logo();
$socials = get_globals_socials();
$legal_page = get_page_by_title('Datenschutz und Impressum', OBJECT, 'page');
?>

<footer data-layout="footer">
    <nav class="nav-container">
        <ul class= "nav">
            <?php foreach ($menu as $item): ?>
                <?php $is_legal_link = in_array(sanitize_title(wp_strip_all_tags($item['title'])), ['datenschutz', 'impressum'], true); ?>
                <?php $item_url = $is_legal_link && $legal_page ? get_permalink($legal_page) : $item['url']; ?>
                <?php $item_target = $is_legal_link && $legal_page ? '_self' : $item['target']; ?>
                <li class="nav-item">
                    <a target="<?= esc_attr($item_target) ?>" href="<?= esc_url($item_url) ?>">
                        <?= esc_html($item['title']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <div class="socials">
        <?php foreach ($socials as $item): ?>
        <a target="_blank" href="<?= $item['link'] ?>" aria-label="Link zu <?= $item['title'] ?>">
           <img src="<?= $item['icon']['src'] ?>" alt="<?= $item['icon']['alt'] ?>">
          </a>
        <?php endforeach; ?>
    </div>
</footer>
