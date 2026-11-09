<?php
$data = $args['data'];
?>

<section data-module="hero_front">
    <h1><?= $data ['title'] ?></h1>
    <?php if ($data['subline']): ?>
      <p class="subline"><?= $data ['subline'] ?></p>
    <?php endif; ?>
    <img class="image" src="<?= $data['image']['src'] ?>" alt="<?= $data ['image']['alt'] ?>">
</section>

