<?php
$data = $args['data'];
?>

<section data-module="lead">
    <p class="lead-text"><?= nl2br(esc_html($data['text'] ?? '')) ?></p>
</section>
