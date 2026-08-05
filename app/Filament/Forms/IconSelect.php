<?php

namespace App\Filament\Forms;

use Filament\Forms\Components\Select;

class IconSelect
{
    public static function solid(string $name = 'icon', ?string $label = 'Icon'): Select
    {
        return self::make($name, $label, 'solid');
    }

    public static function brand(string $name = 'icon', ?string $label = 'Icon'): Select
    {
        return self::make($name, $label, 'brands');
    }

    private static function make(string $name, ?string $label, string $type): Select
    {
        return Select::make($name)
            ->label($label)
            ->options(fn (?string $state): array => self::options($type, $state))
            ->searchable()
            ->allowHtml()
            ->native(false)
            ->required();
    }

    /** @return array<string, string> */
    public static function options(string $type, ?string $current = null): array
    {
        /** @var array<string, string> $icons */
        $icons = config("fontawesome-icons.{$type}", []);

        $options = collect($icons)
            ->mapWithKeys(fn (string $label, string $class): array => [
                $class => self::htmlOption($class, $label),
            ])
            ->all();

        if ($current && ! array_key_exists($current, $options)) {
            $options[$current] = self::htmlOption($current, self::humanizeClass($current));
        }

        return $options;
    }

    public static function labelFor(?string $class): string
    {
        if ($class === null) {
            return '';
        }

        foreach (['solid', 'brands'] as $type) {
            /** @var array<string, string> $icons */
            $icons = config("fontawesome-icons.{$type}", []);

            if (isset($icons[$class])) {
                return $icons[$class];
            }
        }

        return self::humanizeClass($class);
    }

    public static function tableHtml(?string $class): string
    {
        if ($class === null) {
            return '';
        }

        $label = e(self::labelFor($class));

        return "<span class=\"inline-flex items-center gap-2\"><i class=\"{$class}\"></i><span>{$label}</span></span>";
    }

    private static function htmlOption(string $class, string $label): string
    {
        return '<span class="inline-flex items-center gap-2"><i class="'.e($class).'"></i><span>'.e($label).'</span></span>';
    }

    private static function humanizeClass(string $class): string
    {
        $name = str($class)->afterLast(' fa-')->replace('-', ' ')->title()->toString();

        return $name !== '' ? $name : $class;
    }
}
