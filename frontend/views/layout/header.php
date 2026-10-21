<?php
$menu_items = get_menu_by_slug('main');
$logo = get_globals_logo();
?>

<header data-layout="header">
    <img class="logo" src="<?= $logo['src'] ?>" alt="<?= $logo['alt'] ?>">
    <nav class="nav-container">
        <ul class= "nav">
            <?php foreach ($menu_items as $item): ?>
            <li class="nav-item">
                <a target="<?= $item['target'] ?>" href="<?= $item['url'] ?>">
                    <?= $item['title'] ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
