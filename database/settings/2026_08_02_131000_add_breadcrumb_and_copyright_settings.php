<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.show_copyright', true);
        $this->migrator->add('general.breadcrumb_image', 'assets/img/banner/banner.jpg');
        $this->migrator->add('general.breadcrumb_overlay_color', '#000000');
        $this->migrator->add('general.breadcrumb_overlay_opacity', 50);
    }
};
