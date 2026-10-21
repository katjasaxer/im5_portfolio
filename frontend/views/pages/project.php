<?php
$project = get_project_by_id(get_the_ID(), 'page');
?>

<main data-page="project">
    <p class="preline">Projekt</p>
    <h1 class="title"><?= $project['title'] ?></h1>
    <img class="image" src="<?= $project['image']['src'] ?>" alt="<?= $project['image']['alt'] ?>">

    <div class="text">
        <?= wpautop($project['text']) ?>
    </div>
</main>