<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// -> Inhaltsfeld-Konfiguration des Custom Post Type `project`
Container::make('post_meta', 'Projekt')
    ->where('post_type', '=', 'project')
    ->add_fields([
        Field::make('image', 'image', 'Bild')->set_required(),
        Field::make('textarea', 'description', 'Beschreibung')->set_rows(3)->set_required(),
        Field::make('textarea', 'category', 'Kategorie')->set_rows(4)->set_required(),
        Field::make('rich_text', 'text', 'Text')->set_required(),
    ]);