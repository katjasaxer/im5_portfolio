<?php
register_post_type('project', [
    'label' => 'Galerie',
    'labels' => [
        'name' => 'Galerien',
        'singular_name' => 'Galerie',
        'menu_name' => 'Galerien',
        'name_admin_bar' => 'Galerie',
        'all_items' => 'Alle Galerien',
        'add_new_item' => 'Neue Galerie hinzufügen',
        'add_new' => 'Neue Galerie',
        'new_item' => 'Neue Galerie',
        'edit_item' => 'Galerie bearbeiten',
        'update_item' => 'Galerie aktualisieren',
        'view_item' => 'Galerie ansehen',
        'view_items' => 'Galerien ansehen',
        'search_items' => 'Galerie suchen',
        'not_found' => 'Keine Galerie gefunden',
        'not_found_in_trash' => 'Keine Galerie im Papierkorb gefunden',
    ],
    'supports' => ['title'],
    'hierarchical' => false,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 20,
    'menu_icon' => 'dashicons-format-gallery',
    'show_in_admin_bar' => false,
    'show_in_nav_menus' => false,
    'has_archive' => false,
    'exclude_from_search' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'show_in_rest' => false,
    'rewrite' => [
        'slug' => 'galerie',
        'with_front' => false,
        'pages' => true,
        'feeds' => true,
    ],
]);

// Keep old /projekt/{slug}/ links working; WordPress canonicalizes them to /galerie/{slug}/.
add_rewrite_rule('^projekt/([^/]+)/?$', 'index.php?project=$matches[1]', 'top');

// Refresh rewrite rules once after changing the public permalink prefix.
add_action('init', function () {
    $rewrite_version = 'galerie-permalink-v1';
    if (get_option('im5_gallery_rewrite_version') === $rewrite_version) {
        return;
    }

    flush_rewrite_rules(false);
    update_option('im5_gallery_rewrite_version', $rewrite_version, false);
}, 99);
