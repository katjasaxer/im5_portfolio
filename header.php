<!DOCTYPE html>
<html lang="<?php bloginfo('language') ?>">
<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/frontend/styles/main.css?ver=<?= filemtime(get_template_directory() . '/frontend/styles/main.css') ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,viewport-fit=cover" />
    <title><?= esc_html(get_globals_site_title() ?: get_bloginfo('name')) ?></title>
    <?php $site_logo = get_globals_logo(); ?>
    <?php if ($site_logo && !empty($site_logo['src'])): ?>
        <link rel="icon" href="<?= esc_url($site_logo['src']) ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body>
