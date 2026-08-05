<?php

namespace Database\Seeders;

use App\Settings\GeneralSettings;
use Illuminate\Database\Seeder;

class GeneralSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(GeneralSettings::class);

        $settings->site_name = 'Monty Company for Kitchens & Cabinets';
        $settings->logo_path = 'assets/img/logo/logo.webp';
        $settings->favicon_path = null;
        $settings->phone = '0564175052';
        $settings->email = 'montey.info@gmail.com';
        $settings->footer_description = 'Al-Saeed Kitchen Company was launched over 50 years ago to become a leader in designing and implementing kitchens, cupboards, and wooden Laundromats with skilled happiness and innovative minds.';
        $settings->copyright_text = 'You deserve the best from Ocoda';
        $settings->copyright_url = 'https://www.ocoda.com/';
        $settings->google_maps_embed = 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3572.289867615651!2d50.11873808496494!3d26.446383783330653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjbCsDI2JzQ3LjAiTiA1MMKwMDYnNTkuNiJF!5e0!3m2!1sar!2ssa!4v1677764301760!5m2!1sar!2ssa';
        $settings->quote_button_url = '/contact#form';
        $settings->primary_color = '#f8aa27';
        $settings->secondary_color = '#222222';
        $settings->accent_color = '#ffffff';
        $settings->show_copyright = true;
        $settings->breadcrumb_image = 'assets/img/banner/banner.jpg';
        $settings->breadcrumb_overlay_color = '#000000';
        $settings->breadcrumb_overlay_opacity = 50;

        $settings->save();
    }
}
