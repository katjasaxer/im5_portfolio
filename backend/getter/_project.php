<?php

function get_project_by_id(int $id): array{
    //collect data
    $title = get_the_title($id);
    $image_id = carbon_get_post_meta($id, 'image');
    $image = $image_id ? get_media_by_id($image_id, 'full') : false;
    $section_data = carbon_get_post_meta($id, 'project_sections') ?: [];
    // Keep showing the previous single category/gallery for existing projects.
    if (empty($section_data)) {
        $legacy_category = carbon_get_post_meta($id, 'category');
        $legacy_gallery = carbon_get_post_meta($id, 'gallery') ?: [];
        if ($legacy_category || $legacy_gallery) {
            $section_data[] = ['category' => $legacy_category, 'gallery' => $legacy_gallery];
        }
    }
    $sections = array_values(array_filter(array_map(static function ($section) {
        $image_ids = array_filter($section['gallery'] ?? [], static fn ($image_id) => is_numeric($image_id) && (int) $image_id > 0);
        $section['gallery'] = array_values(array_filter(array_map(static function ($image_id) {
            if (get_post_type((int) $image_id) !== 'attachment') {
                return false;
            }

            $image = get_media_by_id((int) $image_id, 'full');
            return is_array($image) && !empty($image['src']) ? $image : false;
        }, $image_ids)));
        return $section;
    }, $section_data), static fn ($section) => !empty($section['category']) || !empty($section['gallery'])));
    $description = carbon_get_post_meta ($id, 'description');
    $text = carbon_get_post_meta($id, 'text');
    //return data
    return[
        'title' => $title,
        'image' => $image,
        'sections' => $sections,
        'description' => $description,
        'text' => $text,
    ];

}
