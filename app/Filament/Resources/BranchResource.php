<?php

namespace App\Filament\Resources;

use App\Filament\Forms\IconSelect;
use App\Filament\Forms\LocaleFields;
use App\Filament\Resources\BranchResource\Pages;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Branches';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Branch settings')
                    ->schema([
                        IconSelect::solid()
                            ->default('fa-solid fa-code-branch'),
                        Forms\Components\TextInput::make('sort_order')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Contact information')
                    ->description('Independent contact details for this branch on the website.')
                    ->schema([
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->placeholder('0564175052'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->placeholder('branch@example.com'),
                        Forms\Components\TextInput::make('whatsapp')
                            ->tel()
                            ->label('WhatsApp')
                            ->placeholder('966564175052')
                            ->helperText('Numbers only, with country code.'),
                    ])
                    ->columns(3),

                LocaleFields::tabs(fn (string $locale) => [
                    LocaleFields::text('name', 'Branch name', $locale),
                    LocaleFields::textarea('address', 'Address', $locale, 3),
                ], 'Branch text'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(fn (Branch $record) => $record->getTranslation('name', 'en')),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('whatsapp'),
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
