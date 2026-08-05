<?php



namespace App\Filament\Resources;



use App\Filament\Forms\LocaleFields;

use App\Filament\Forms\MediaUpload;

use App\Filament\Resources\WorkProcessStepResource\Pages;

use App\Models\WorkProcessStep;

use Filament\Forms;

use Filament\Forms\Form;

use Filament\Resources\Resource;

use Filament\Tables;

use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletingScope;



class WorkProcessStepResource extends Resource

{

    protected static ?string $model = WorkProcessStep::class;



    protected static ?string $navigationIcon = 'heroicon-o-queue-list';



    protected static ?string $navigationGroup = 'Homepage';



    protected static ?int $navigationSort = 4;



    protected static ?string $navigationLabel = 'Work Process';



    public static function form(Form $form): Form

    {

        return $form

            ->schema([

                Forms\Components\Grid::make()

                    ->schema([

                        Forms\Components\Section::make('Step image')

                            ->schema([

                                MediaUpload::image('image_path', 'Image', 'assets/uploads/work-process')

                                    ->columnSpanFull(),

                            ])

                            ->columnSpan(['lg' => 1]),



                        Forms\Components\Section::make('Settings')

                            ->schema([

                                Forms\Components\TextInput::make('number')

                                    ->required()

                                    ->maxLength(10),

                                Forms\Components\Select::make('layout')

                                    ->options([

                                        'image-left' => 'Image left',

                                        'image-right' => 'Image right',

                                    ])

                                    ->required()

                                    ->default('image-left'),

                                Forms\Components\TextInput::make('sort_order')

                                    ->numeric()

                                    ->default(0)

                                    ->required(),

                                Forms\Components\Toggle::make('is_active')

                                    ->label('Active')

                                    ->default(true)

                                    ->inline(false),

                            ])

                            ->columns(2)

                            ->columnSpan(['lg' => 1]),

                    ])

                    ->columns(['lg' => 2]),



                LocaleFields::tabs(fn (string $locale) => [

                    LocaleFields::text('title', 'Step title', $locale),

                    LocaleFields::textarea('description', 'Description', $locale, 4),

                ], 'Step content'),

            ]);

    }



    public static function table(Table $table): Table

    {

        return $table

            ->columns([

                Tables\Columns\TextColumn::make('number'),

                Tables\Columns\ImageColumn::make('image_path')

                    ->disk('public_assets')

                    ->square(),

                Tables\Columns\TextColumn::make('title')

                    ->formatStateUsing(fn (WorkProcessStep $record) => $record->getTranslation('title', 'en')),

                Tables\Columns\TextColumn::make('layout'),

                Tables\Columns\IconColumn::make('is_active')->boolean(),

                Tables\Columns\TextColumn::make('sort_order')->sortable(),

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

            'index' => Pages\ListWorkProcessSteps::route('/'),

            'create' => Pages\CreateWorkProcessStep::route('/create'),

            'edit' => Pages\EditWorkProcessStep::route('/{record}/edit'),

        ];

    }



    public static function getEloquentQuery(): Builder

    {

        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);

    }

}


