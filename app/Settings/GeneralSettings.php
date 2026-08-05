<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;

    public ?string $logo_path;

    public ?string $favicon_path;

    public string $phone;

    public string $email;

    public ?string $footer_description;

    public ?string $copyright_text;

    public ?string $copyright_url;

    public ?string $google_maps_embed;

    public ?string $quote_button_url;

    public string $primary_color;

    public string $secondary_color;

    public string $accent_color;

    public bool $show_copyright;

    public ?string $breadcrumb_image;

    public string $breadcrumb_overlay_color;

    public int $breadcrumb_overlay_opacity;

    public static function group(): string
    {
        return 'general';
    }
}
