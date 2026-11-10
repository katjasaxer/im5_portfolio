<?php
$data = $args['data'];
?>

<section data-module="text">
    <h2 class="title"><?= esc_html($data['title'] ?? '') ?></h2>
    <div class="copy"><?= nl2br(esc_html($data['text'] ?? '')) ?></div>
</section>
