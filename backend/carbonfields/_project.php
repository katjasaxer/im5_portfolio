<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Inhaltsfeld-Konfiguration des Custom Post Type `project`
Container::make('post_meta', 'Galerie')
    ->where('post_type', '=', 'project')
    ->add_fields([
        Field::make('image', 'image', 'Bild')->set_required(),
        Field::make('textarea', 'description', 'Beschreibung')->set_rows(3)->set_required(),
        Field::make('complex', 'project_sections', 'Galerie-Inhalte')
            ->add_fields([
                Field::make('text', 'category', 'Kategorie')->set_required(),
                Field::make('media_gallery', 'gallery', 'Bildergalerie')
                    ->set_type(['image']),
            ])
            ->set_layout('tabbed-vertical'),
        Field::make('rich_text', 'text', 'Text'),
    ]);
