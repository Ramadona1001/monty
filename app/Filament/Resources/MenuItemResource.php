<?php



namespace App\Filament\Resources;



use App\Filament\Forms\LocaleFields;

use App\Filament\Resources\MenuItemResource\Pages;

use App\Models\MenuItem;

use Filament\Forms;

use Filament\Forms\Form;

use Filament\Resources\Resource;

use Filament\Tables;

use Filament\Tables\Table;



class MenuItemResource extends Resource

{

    protected static ?string $model = MenuItem::class;



    protected static ?string $navigationIcon = 'heroicon-o-bars-3';



    protected static ?string $navigationGroup = 'Site';



    protected static ?int $navigationSort = 3;



    public static function form(Form $form): Form

    {

        return $form

            ->schema([

                Forms\Components\Section::make('Menu item')

                    ->schema([

                        Forms\Components\Select::make('route_name')

                            ->label('Page')

                            ->options([

                                'home' => 'Home',

                                'about' => 'About',

                                'services' => 'Services',

                                'contact' => 'Contact',

                            ])

                            ->required(),

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



                LocaleFields::tabs(fn (string $locale) => [

                    LocaleFields::text('label', 'Navigation label', $locale),

                ], 'Menu label'),

            ]);

    }



    public static function table(Table $table): Table

    {

        return $table

            ->columns([

                Tables\Columns\TextColumn::make('route_name'),

                Tables\Columns\TextColumn::make('label')

                    ->formatStateUsing(fn (MenuItem $record) => $record->getTranslation('label', 'en')),

                Tables\Columns\IconColumn::make('is_active')->boolean(),

                Tables\Columns\TextColumn::make('sort_order')->sortable(),

            ])

            ->defaultSort('sort_order')

            ->reorderable('sort_order')

            ->actions([Tables\Actions\EditAction::make()])

            ->bulkActions([]);

    }



    public static function getPages(): array

    {

        return [

            'index' => Pages\ListMenuItems::route('/'),

            'edit' => Pages\EditMenuItem::route('/{record}/edit'),

        ];

    }



    public static function canCreate(): bool

    {

        return false;

    }

}


