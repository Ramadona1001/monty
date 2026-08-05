<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Monty Company for Kitchens & Cabinets');
        $this->migrator->add('general.logo_path', 'assets/img/logo/logo.webp');
        $this->migrator->add('general.favicon_path', null);
        $this->migrator->add('general.phone', '0564175052');
        $this->migrator->add('general.email', 'montey.info@gmail.com');
        $this->migrator->add('general.footer_description', 'Al-Saeed Kitchen Company was launched over 50 years ago to become a leader in designing and implementing kitchens, cupboards, and wooden Laundromats with skilled happiness and innovative minds.');
        $this->migrator->add('general.copyright_text', 'You deserve the best from Ocoda');
        $this->migrator->add('general.copyright_url', 'https://www.ocoda.com/');
        $this->migrator->add('general.google_maps_embed', 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3572.289867615651!2d50.11873808496494!3d26.446383783330653!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjbCsDI2JzQ3LjAiTiA1MMKwMDYnNTkuNiJF!5e0!3m2!1sar!2ssa!4v1677764301760!5m2!1sar!2ssa');
        $this->migrator->add('general.quote_button_url', '/contact#form');
    }
};
