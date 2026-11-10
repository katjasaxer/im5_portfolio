<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

$overview_gallery_fields = [];
$overview_gallery_fields[] = Field::make('text', 'gallery_title', 'Galerie-Titel');
for ($slot = 1; $slot <= 4; $slot++) {
    $overview_gallery_fields[] = Field::make('text', "item_title_{$slot}", "Bild {$slot}: Titel");
    $overview_gallery_fields[] = Field::make('association', "item_category_{$slot}", "Bild {$slot}: Projektkategorie")
        ->set_types([
            [
                'type' => 'term',
                'taxonomy' => 'project_category',
            ],
        ])
        ->set_max(1);
    $overview_gallery_fields[] = Field::make('image', "item_image_{$slot}", "Bild {$slot}: Datei");
}

// -> Konfiguration der verschiedenen Module
Container::make('post_meta', 'Module')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('complex', 'modules', 'Module')
            // -> example
            ->add_fields('example', 'Beispiel', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('image', 'image', 'Bild')->set_required(),
            ])
            // -> hero_front
            ->add_fields('hero_front', 'Hero Startseite', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('textarea', 'subline', 'Subline'),
                Field::make('image', 'image', 'Bild')->set_required(),
                ])
            // -> lead
            ->add_fields('lead', 'Lead', [
                Field::make('textarea', 'text', 'Lead-Text')->set_rows(3)->set_required(),
            ])
            // -> text
            ->add_fields('text', 'Text', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('textarea', 'text', 'Text')->set_rows(6)->set_required(),
            ])
            // -> overview_gallery
            ->add_fields('overview_gallery', 'Galerie', $overview_gallery_fields)
            // -> contact
            ->add_fields('contact', 'Contact', [
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('textarea', 'text', 'Text')->set_rows(3)->set_required(),
                Field::make('text', 'email', 'E-Mail-Adresse')
                    ->set_attribute('type', 'email')
                    ->set_required(),
                Field::make('text', 'button_text', 'Button-Text'),
            ])
            // -> about_me
            ->add_fields('about_me', 'Über mich', [
                Field::make('image', 'image', 'Foto')->set_required(),
                Field::make('text', 'title', 'Titel')->set_required(),
                Field::make('textarea', 'text_1', 'Text 1')->set_rows(4)->set_required(),
                Field::make('textarea', 'text_2', 'Text 2')->set_rows(4)->set_required(),
            ])

            // todo: add new modules here
            // -> SETTINGS
            ->set_layout('tabbed-vertical')
    ]);

// -> Funktion, um die Module und die entsprechenden Templates auf der Seite zu laden
function render_modules (): void {
    $modules = carbon_get_the_post_meta('modules');
    if (empty($modules)) {
        return;
    }
    foreach ($modules as $module) {
        // -> Modifiziere die Daten des Moduls, falls nötig, basierend auf dem Modultyp
        switch ($module['_type']) {
            case 'hero_front':
                $module['image'] = get_media_by_id($module['image'], 'full');
                break;
            case 'about_me':
                $module['image'] = !empty($module['image'])
                    ? get_media_by_id($module['image'], 'full')
                    : false;
                break;
                // todo: add data modifications for modules here as a new case
            case 'overview_gallery':
                $format_gallery_item = static function ($title, $image_id, $category_data) {
                    $image = $image_id ? get_media_by_id($image_id, 'm') : false;
                    $category = is_array($category_data) ? ($category_data[0] ?? null) : null;
                    $term = $category && ($category['type'] ?? '') === 'term'
                        ? get_term((int) $category['id'], $category['subtype'] ?? 'project_category')
                        : null;
                    if (!$term && !empty($category['id'])) {
                        $term = get_term((int) $category['id'], 'project_category');
                    }
                    if (!$term && !empty($category['value']) && preg_match('/term:[^:]+:(\d+)/', $category['value'], $matches)) {
                        $term = get_term((int) $matches[1], 'project_category');
                    }
                    if (!$term && is_string($category_data) && $category_data !== '') {
                        $term = get_term_by('name', $category_data, 'project_category');
                    }
                    $term_url = $term && !is_wp_error($term) ? get_term_link($term) : false;

                    return $image && !empty($image['src'])
                        ? [
                            'title' => $title,
                            'image' => $image,
                            'category' => $term_url && !is_wp_error($term_url)
                                ? ['name' => $term->name, 'url' => $term_url]
                                : false,
                        ]
                        : false;
                };

                $old_items = $module['items'] ?? [];
                $module['items'] = [];
                for ($slot = 1; $slot <= 4; $slot++) {
                    $item = $format_gallery_item(
                        $module["item_title_{$slot}"] ?? '',
                        $module["item_image_{$slot}"] ?? 0,
                        $module["item_category_{$slot}"] ?? []
                    );
                    if ($item) {
                        $module['items'][] = $item;
                    }
                }

                // Keep cards entered in the previous repeatable structure visible.
                if (empty($module['items']) && !empty($old_items)) {
                    foreach ($old_items as $old_item) {
                        $item = $format_gallery_item(
                            $old_item['title'] ?? '',
                            $old_item['image'] ?? 0,
                            $old_item['category'] ?? []
                        );
                        if ($item) {
                            $module['items'][] = $item;
                        }
                    }
                }
                // Also keep the original one-card fields visible as the first card.
                if (empty($module['items']) && !empty($module['image'])) {
                    $item = $format_gallery_item(
                        $module['title'] ?? '',
                        $module['image'],
                        $module['categorie'] ?? ($module['category'] ?? [])
                    );
                    if ($item) {
                        $module['items'][] = $item;
                    }
                }
                break;
            case 'contact':
                break;
        }
        // -> Laden des Templates basierend auf dem Modultyp und weitergeben der Daten
        get_template_part(
            'frontend/views/modules/' . $module['_type'],
            null,
            [
                'data' => $module
            ]
        );


    }
}
