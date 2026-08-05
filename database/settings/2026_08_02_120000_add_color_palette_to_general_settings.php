<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.primary_color', '#f8aa27');
        $this->migrator->add('general.secondary_color', '#222222');
        $this->migrator->add('general.accent_color', '#ffffff');
    }
};
