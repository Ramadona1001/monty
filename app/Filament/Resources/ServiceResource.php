<?php



namespace App\Filament\Resources;



use App\Filament\Forms\LocaleFields;

use App\Filament\Forms\MediaUpload;

use App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource\RelationManagers;

use App\Models\Service;

use Filament\Forms;

use Filament\Forms\Form;

use Filament\Resources\Resource;

use Filament\Tables;

use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletingScope;



class ServiceResource extends Resource

{

    protected static ?string $model = Service::class;



    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';



    protected static ?string $navigationGroup = 'Content';



    protected static ?int $navigationSort = 2;



    public static function form(Form $form): Form

    {

        return $form

            ->schema([

                Forms\Components\Grid::make()

                    ->schema([

                        Forms\Components\Section::make('Service details')

                            ->schema([

                                Forms\Components\TextInput::make('slug')

                                    ->required()

                                    ->maxLength(255),

                                Forms\Components\TextInput::make('number')

                                    ->required()

                                    ->maxLength(10),

                                Forms\Components\TextInput::make('sort_order')

                                    ->numeric()

                                    ->default(0)

                                    ->required(),

                                Forms\Components\Toggle::make('is_featured')

                                    ->label('Featured on homepage')

                                    ->inline(false),

                                Forms\Components\Toggle::make('is_active')

                                    ->label('Active')

                                    ->default(true)

                                    ->inline(false),

                            ])

                            ->columns(2)

                            ->columnSpan(['lg' => 1]),



                        Forms\Components\Section::make('Featured image')

                            ->schema([

                                MediaUpload::image('featured_image', 'Featured image', 'assets/uploads/services')

                                    ->columnSpanFull(),

                            ])

                            ->columnSpan(['lg' => 1]),

                    ])

                    ->columns(['lg' => 2]),



                LocaleFields::tabs(fn (string $locale) => [

                    LocaleFields::text('title', 'Title', $locale),

                    LocaleFields::textarea('excerpt', 'Excerpt', $locale, 3),

                    LocaleFields::textarea('body', 'Full description', $locale, 8),

                ], 'Service content'),

            ]);

    }



    public static function table(Table $table): Table

    {

        return $table

            ->columns([

                Tables\Columns\ImageColumn::make('featured_image')

                    ->disk('public_assets'),

                Tables\Columns\TextColumn::make('title')

                    ->formatStateUsing(fn (Service $record) => $record->getTranslation('title', 'en'))

                    ->searchable(),

                Tables\Columns\IconColumn::make('is_featured')->boolean(),

                Tables\Columns\IconColumn::make('is_active')->boolean(),

                Tables\Columns\TextColumn::make('sort_order')->sortable(),

            ])

            ->defaultSort('sort_order')

            ->reorderable('sort_order')

            ->filters([Tables\Filters\TrashedFilter::make()])

            ->actions([Tables\Actions\EditAction::make()])

            ->bulkActions([

                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\DeleteBulkAction::make(),

                ]),

            ]);

    }



    public static function getRelations(): array

    {

        return [

            RelationManagers\ImagesRelationManager::class,

            RelationManagers\FeaturesRelationManager::class,

        ];

    }



    public static function getPages(): array

    {

        return [

            'index' => Pages\ListServices::route('/'),

            'create' => Pages\CreateService::route('/create'),

            'edit' => Pages\EditService::route('/{record}/edit'),

        ];

    }



    public static function getEloquentQuery(): Builder

    {

        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);

    }

}


