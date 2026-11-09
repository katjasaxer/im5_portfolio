<?php
register_taxonomy(
    'project_category',
    ['project'],
    [
        'label' => 'Projektkategorie',
        'labels' => [
            'name' => 'Projektkategorien',
            'singular_name' => 'Projektkategorie',
            'menu_name' => 'Projektkategorien',
            'all_items' => 'Alle Projektkategorien',
            'edit_item' => 'Projektkategorie bearbeiten',
            'view_item' => 'Projektkategorie ansehen',
            'update_item' => 'Projektkategorie updaten',
            'add_new_item' => 'Neue Projektkategorie hinzufügen',
        ],
        'public' => true,
        'show_in_rest' => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'Projektkategorie'],
    ],
);