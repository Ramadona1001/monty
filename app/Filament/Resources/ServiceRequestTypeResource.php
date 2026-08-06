<?php

namespace App\Filament\Resources;

use App\Filament\Forms\IconSelect;
use App\Filament\Forms\LocaleFields;
use App\Filament\Resources\ServiceRequestTypeResource\Pages;
use App\Models\ServiceRequestType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceRequestTypeResource extends Resource
{
    protected static ?string $model = ServiceRequestType::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Request service types';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->alphaDash(),
                        IconSelect::solid()
                            ->default('fa-solid fa-ruler-combined'),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(2),

                LocaleFields::tabs(fn (string $locale) => [
                    LocaleFields::text('name', 'Name', $locale),
                    LocaleFields::textarea('description', 'Description', $locale, 3),
                ], 'Service type text'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('icon')
                    ->html()
                    ->formatStateUsing(fn (?string $state) => IconSelect::tableHtml($state)),
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(fn (ServiceRequestType $record) => $record->getTranslation('name', 'en')),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([Tables\Filters\TrashedFilter::make()])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceRequestTypes::route('/'),
            'create' => Pages\CreateServiceRequestType::route('/create'),
            'edit' => Pages\EditServiceRequestType::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
