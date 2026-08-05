<?php

namespace App\Filament\Forms;

use Closure;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class LocaleFields
{
    /**
     * @param  Closure(string): list<Component>  $fields
     */
    public static function tabs(Closure $fields, ?string $label = 'Translations'): Tabs
    {
        return Tabs::make($label)
            ->tabs([
                Tab::make('English')
                    ->icon('heroicon-o-language')
                    ->schema($fields('en')),
                Tab::make('العربية')
                    ->icon('heroicon-o-language')
                    ->schema($fields('ar')),
            ])
            ->columnSpanFull()
            ->contained(false);
    }

    public static function text(string $name, ?string $label, string $locale): TextInput
    {
        $label ??= str($name)->headline()->toString();

        return TextInput::make("{$name}.{$locale}")
            ->label($label)
            ->extraInputAttributes(['dir' => $locale === 'ar' ? 'rtl' : 'ltr']);
    }

    public static function textarea(string $name, ?string $label, string $locale, int $rows = 3): Textarea
    {
        $label ??= str($name)->headline()->toString();

        return Textarea::make("{$name}.{$locale}")
            ->label($label)
            ->rows($rows)
            ->extraInputAttributes(['dir' => $locale === 'ar' ? 'rtl' : 'ltr']);
    }

    public static function tags(string $name, ?string $label, string $locale): TagsInput
    {
        $label ??= str($name)->headline()->toString();

        return TagsInput::make("{$name}.{$locale}")
            ->label($label)
            ->extraInputAttributes(['dir' => $locale === 'ar' ? 'rtl' : 'ltr']);
    }
}
