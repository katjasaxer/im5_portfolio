<?php
$data = $args['data'];
?>

<section id="contact" data-module="contact">
    <h3 class="title"><?= esc_html($data['title'] ?? '') ?></h3>
    <h2 class="text"><?= nl2br(esc_html($data['text'] ?? '')) ?></h2>
    <?php if (!empty($data['email'])): ?>
        <a class="email-button" href="<?= esc_url('mailto:' . sanitize_email($data['email'])) ?>">
            <?= esc_html($data['button_text'] ?? '') ?: 'E-Mail schreiben' ?>
        </a>
    <?php endif; ?>
</section>

