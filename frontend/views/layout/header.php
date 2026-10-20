<?php
$menu = get_menu_by_slug('main');
?>

<header data-layout="header">
    <mark>hier kommt das Logo</mark>
    <nav class="nav-container">
        <ul class= "nav">
            <?php foreach ($menu as $item): ?>
            <li class="nav-item">
                <a target="<?= $item['target'] ?>" href="<?= $item['url'] ?>">
                    <?= $item['title'] ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</header>
