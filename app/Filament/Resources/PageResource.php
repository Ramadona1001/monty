<?php



namespace App\Filament\Resources;



use App\Filament\Forms\LocaleFields;

use App\Filament\Forms\MediaUpload;

use App\Filament\Resources\PageResource\Pages;

use App\Models\Page;

use Filament\Forms;

use Filament\Forms\Form;

use Filament\Resources\Resource;

use Filament\Tables;

use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Database\Eloquent\SoftDeletingScope;



class PageResource extends Resource

{

    protected static ?string $model = Page::class;



    protected static ?string $navigationIcon = 'heroicon-o-document-text';



    protected static ?string $navigationGroup = 'Content';



    protected static ?int $navigationSort = 1;



    public static function form(Form $form): Form

    {

        return $form

            ->schema([

                Forms\Components\Grid::make()

                    ->schema([

                        Forms\Components\Section::make('Page settings')

                            ->schema([

                                Forms\Components\TextInput::make('slug')

                                    ->required()

                                    ->maxLength(255)

                                    ->disabled(fn (?Page $record) => $record !== null),

                                Forms\Components\Select::make('status')

                                    ->options([

                                        'published' => 'Published',

                                        'draft' => 'Draft',

                                    ])

                                    ->required()

                                    ->default('published'),

                                Forms\Components\DateTimePicker::make('published_at'),

                            ])

                            ->columns(3)

                            ->columnSpan(['lg' => 1]),



                        Forms\Components\Section::make('Banner')

                            ->schema([

                                MediaUpload::image('banner_image', 'Banner image', 'assets/uploads/pages')

                                    ->columnSpanFull(),

                            ])

                            ->columnSpan(['lg' => 1]),

                    ])

                    ->columns(['lg' => 2]),



                LocaleFields::tabs(fn (string $locale) => [

                    LocaleFields::text('title', 'Page title', $locale),

                    LocaleFields::textarea('content', 'Page content', $locale, 8),

                ], 'Page content'),



                Forms\Components\Section::make('SEO')

                    ->schema([

                        LocaleFields::tabs(fn (string $locale) => [

                            LocaleFields::text('seo_title', 'SEO title', $locale),

                            LocaleFields::textarea('seo_description', 'SEO description', $locale, 3),

                            LocaleFields::text('meta_keywords', 'Meta keywords', $locale),

                            LocaleFields::text('og_title', 'Open Graph title', $locale),

                            LocaleFields::textarea('og_description', 'Open Graph description', $locale, 3),

                        ], 'SEO translations'),

                    ])

                    ->collapsed(),

            ]);

    }



    public static function table(Table $table): Table

    {

        return $table

            ->columns([

                Tables\Columns\TextColumn::make('slug')

                    ->searchable()

                    ->sortable(),

                Tables\Columns\TextColumn::make('title')

                    ->formatStateUsing(fn (Page $record) => $record->getTranslation('title', 'en'))

                    ->searchable(),

                Tables\Columns\TextColumn::make('status')

                    ->badge(),

                Tables\Columns\TextColumn::make('updated_at')

                    ->dateTime()

                    ->sortable(),

            ])

            ->defaultSort('slug')

            ->filters([

                Tables\Filters\TrashedFilter::make(),

            ])

            ->actions([

                Tables\Actions\EditAction::make(),

            ])

            ->bulkActions([]);

    }



    public static function getPages(): array

    {

        return [

            'index' => Pages\ListPages::route('/'),

            'edit' => Pages\EditPage::route('/{record}/edit'),

        ];

    }



    public static function getEloquentQuery(): Builder

    {

        return parent::getEloquentQuery()

            ->withoutGlobalScopes([

                SoftDeletingScope::class,

            ]);

    }



    public static function canCreate(): bool

    {

        return false;

    }

}


