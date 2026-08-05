<?php

namespace App\Filament\Resources;

use App\Filament\Forms\LocaleFields;
use App\Filament\Resources\UiTranslationResource\Pages;
use App\Models\UiTranslation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UiTranslationResource extends Resource
{
    protected static ?string $model = UiTranslation::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'UI Translations';

    protected static ?string $modelLabel = 'UI translation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Translation key')
                    ->description('Used as site.{group}.{key} on the frontend.')
                    ->schema([
                        Forms\Components\Select::make('group')
                            ->options([
                                'nav' => 'Navigation',
                                'footer' => 'Footer',
                                'pages' => 'Pages',
                                'buttons' => 'Buttons',
                                'contact' => 'Contact form',
                            ])
                            ->required()
                            ->native(false)
                            ->disabled(fn (?UiTranslation $record) => $record !== null),
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->maxLength(100)
                            ->helperText('Example: home, read_more, send')
                            ->disabled(fn (?UiTranslation $record) => $record !== null),
                    ])
                    ->columns(2),

                LocaleFields::tabs(fn (string $locale) => [
                    LocaleFields::textarea('value', 'Text', $locale, $locale === 'ar' ? 3 : 2),
                ], 'Translation text'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('group')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('key')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('English')
                    ->formatStateUsing(fn (UiTranslation $record) => $record->getTranslation('value', 'en'))
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('value_ar')
                    ->label('Arabic')
                    ->formatStateUsing(fn (UiTranslation $record) => $record->getTranslation('value', 'ar'))
                    ->limit(50),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('group')
            ->groups([
                Tables\Grouping\Group::make('group')
                    ->label('Group')
                    ->collapsible(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'nav' => 'Navigation',
                        'footer' => 'Footer',
                        'pages' => 'Pages',
                        'buttons' => 'Buttons',
                        'contact' => 'Contact form',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUiTranslations::route('/'),
            'create' => Pages\CreateUiTranslation::route('/create'),
            'edit' => Pages\EditUiTranslation::route('/{record}/edit'),
        ];
    }
}
