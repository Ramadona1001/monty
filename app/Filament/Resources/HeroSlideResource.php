<?php

namespace App\Filament\Resources;

use App\Filament\Forms\LocaleFields;
use App\Filament\Forms\MediaUpload;
use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HeroSlideResource extends Resource
{
    protected static ?string $model = HeroSlide::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Homepage';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        Forms\Components\Section::make('Background')
                            ->description('Hero slide image shown on the homepage carousel.')
                            ->schema([
                                MediaUpload::image('background_image', 'Background image', 'assets/uploads/hero')
                                    ->required()
                                    ->columnSpanFull(),
                                Forms\Components\ColorPicker::make('overlay_color')
                                    ->label('Overlay color')
                                    ->default('#000000')
                                    ->required(),
                                Forms\Components\TextInput::make('overlay_opacity')
                                    ->label('Overlay opacity')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->step(5)
                                    ->default(0)
                                    ->helperText('0 = no overlay, 100 = fully covered')
                                    ->suffix('%'),
                            ])
                            ->columnSpan(['lg' => 1]),

                        Forms\Components\Section::make('Settings')
                            ->schema([
                                Forms\Components\TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Active')
                                    ->default(true)
                                    ->inline(false),
                                Forms\Components\TextInput::make('button_url')
                                    ->label('Button URL')
                                    ->placeholder('Leave empty for contact form')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->columnSpan(['lg' => 1]),
                    ])
                    ->columns(['lg' => 2]),

                LocaleFields::tabs(fn (string $locale) => [
                    LocaleFields::text('subtitle', 'Subtitle', $locale),
                    LocaleFields::text('title', 'Title', $locale),
                    LocaleFields::text('tagline', 'Tagline', $locale),
                    LocaleFields::text('button_text', 'Button text', $locale),
                ], 'Slide text'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\ImageColumn::make('background_image')
                    ->disk('public_assets')
                    ->square(),
                Tables\Columns\TextColumn::make('title')
                    ->formatStateUsing(fn (HeroSlide $record) => $record->getTranslation('title', 'en')),
                Tables\Columns\ColorColumn::make('overlay_color')
                    ->label('Overlay'),
                Tables\Columns\TextColumn::make('overlay_opacity')
                    ->label('Opacity')
                    ->suffix('%'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHeroSlides::route('/'),
            'create' => Pages\CreateHeroSlide::route('/create'),
            'edit' => Pages\EditHeroSlide::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
