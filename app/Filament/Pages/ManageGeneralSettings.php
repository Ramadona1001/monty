<?php

namespace App\Filament\Pages;

use App\Filament\Forms\MediaUpload;
use App\Settings\GeneralSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageGeneralSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Color palette')
                    ->description('Brand colors used on the public website and admin panel.')
                    ->schema([
                        ColorPicker::make('primary_color')
                            ->label('Primary color')
                            ->helperText('Buttons, headings, accents')
                            ->default('#f8aa27')
                            ->required(),
                        ColorPicker::make('secondary_color')
                            ->label('Secondary color')
                            ->helperText('Dark text and footer backgrounds')
                            ->default('#222222')
                            ->required(),
                        ColorPicker::make('accent_color')
                            ->label('Accent color')
                            ->helperText('Light contrast color on primary buttons')
                            ->default('#ffffff')
                            ->required(),
                    ])
                    ->columns(3),

                Section::make('Breadcrumb banner')
                    ->description('Background shown on About, Services, and Contact page headers.')
                    ->schema([
                        MediaUpload::image('breadcrumb_image', 'Breadcrumb image', 'assets/uploads/breadcrumb'),
                        ColorPicker::make('breadcrumb_overlay_color')
                            ->label('Overlay color')
                            ->default('#000000')
                            ->required(),
                        TextInput::make('breadcrumb_overlay_opacity')
                            ->label('Overlay opacity')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(5)
                            ->default(50)
                            ->helperText('0 = no overlay, 100 = fully covered')
                            ->suffix('%'),
                    ])
                    ->columns(3),

                Section::make('Site identity')
                    ->schema([
                        Grid::make()
                            ->schema([
                                Section::make('Branding')
                                    ->schema([
                                        TextInput::make('site_name')
                                            ->required()
                                            ->maxLength(255),
                                        MediaUpload::image('logo_path', 'Logo', 'assets/uploads/logo'),
                                        MediaUpload::favicon(),
                                    ])
                                    ->columnSpan(['lg' => 1]),

                                Section::make('Contact')
                                    ->schema([
                                        TextInput::make('phone')
                                            ->tel()
                                            ->required(),
                                        TextInput::make('email')
                                            ->email()
                                            ->required(),
                                        TextInput::make('quote_button_url')
                                            ->label('Quote button URL'),
                                    ])
                                    ->columnSpan(['lg' => 1]),
                            ])
                            ->columns(['lg' => 2]),
                    ]),

                Section::make('Footer & map')
                    ->schema([
                        Textarea::make('footer_description')
                            ->rows(4)
                            ->columnSpanFull(),
                        Toggle::make('show_copyright')
                            ->label('Show copyright bar')
                            ->default(true)
                            ->live()
                            ->inline(false),
                        TextInput::make('copyright_text')
                            ->visible(fn ($get) => $get('show_copyright')),
                        TextInput::make('copyright_url')
                            ->url()
                            ->visible(fn ($get) => $get('show_copyright')),
                        Textarea::make('google_maps_embed')
                            ->label('Google Maps embed URL')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
