<?php

// -> Logo aus den globalen Einstellungen laden
function get_globals_logo(): array|false {
    $logo_id = carbon_get_theme_option('logo');
    if (!$logo_id) {
        return false;
    }
    return get_media_by_id($logo_id, 'xs');
}

// -> Socials aus den globalen Einstellungen laden
function get_globals_socials(): array {
    $socials = carbon_get_theme_option('socials') ?? [];
    foreach ($socials as $key => $social) {
        $socials[$key]['icon'] = get_media_by_id($social['icon'], 'xs');
    }
    return $socials;
}