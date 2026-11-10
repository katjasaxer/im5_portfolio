<?php
/**
 * Funktionen in dieser Datei können überall im Projekt verwendet werden.
 * Wenn eine neue globale Funktion benötigt wird, bitte hier ergänzen.
 *
 * Diese globalen Funktionen sind nicht Wordpress-spezifisch.
 */

// -> PHP-Daten in der Browser-Konsole anzeigen
function js_log(mixed ...$content): void
{
    foreach ($content as $c) {
        echo '<script>console.log(' . json_encode($c) . ')</script>';
    }
}

// -> Details einer Mediendatei anhand der ID laden
function get_media_by_id(int|string $id, string $size = 'm'): false|array
{
    $id = (int) $id;
    $data = [
        'title' => get_the_title($id),
        'alt' => get_post_meta($id, '_wp_attachment_image_alt', true) ?: get_the_title($id),
        'caption' => get_post_field('post_excerpt', $id),
        'year' => get_post_meta($id, '_gallery_year', true),
    ];
    $image = wp_get_attachment_image_src($id, $size);
    if ($image) {
        $data['src'] = $image[0];
        $data['width'] = $image[1];
        $data['height'] = $image[2];
        $data['type'] = 'image';
    } else {
        $data['src'] = wp_get_attachment_url($id);
        $data['type'] = get_post_mime_type($id);
    }
    return $data;
}

// -> Custom year field in the media library attachment details.
add_filter('attachment_fields_to_edit', function (array $fields, WP_Post $post): array {
    // The caption is WordPress's existing attachment caption (post_excerpt).
    if (isset($fields['post_excerpt'])) {
        $fields['post_excerpt']['required'] = true;
    }

    $fields['gallery_year'] = [
        'label' => 'Jahr',
        'input' => 'text',
        'value' => get_post_meta($post->ID, '_gallery_year', true),
        'required' => true,
        'helps' => 'Jahr, das unter dem Bild in der Projektgalerie angezeigt wird.',
    ];
    return $fields;
}, 10, 2);

add_filter('attachment_fields_to_save', function (array $post, array $attachment): array {
    if (isset($attachment['gallery_year'])) {
        update_post_meta((int) $post['ID'], '_gallery_year', sanitize_text_field($attachment['gallery_year']));
    }
    return $post;
}, 10, 2);

// -> Ein Menu anhand des Keys laden
function get_menu_by_slug(string $slug): array
{
    $theme_locations = get_nav_menu_locations();
    if (!array_key_exists($slug, $theme_locations)) {
        return [];
    }
    $menu_obj = get_term($theme_locations[$slug], 'nav_menu');
    $menu = wp_get_nav_menu_items($menu_obj->name) ?: [];
    $items = [];
    foreach ($menu as $item) {
        $items[] = [
            'ID' => (int) $item->ID,
            'title' => $item->title,
            'url' => $item->url,
            'target' => $item->target,
        ];
    }
    return $items;
}
