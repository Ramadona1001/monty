<?php

namespace App\Filament\Resources;

use App\Filament\Forms\LocaleFields;
use App\Filament\Forms\MediaUpload;
use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Site';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Gallery';

    protected static ?string $modelLabel = 'Gallery item';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\Select::make('media_type')
                            ->options([
                                GalleryItem::TYPE_IMAGE => 'Image',
                                GalleryItem::TYPE_VIDEO => 'Video',
                            ])
                            ->required()
                            ->live()
                            ->default(GalleryItem::TYPE_IMAGE),
                        Forms\Components\Radio::make('media_source')
                            ->label('Media source')
                            ->options([
                                'upload' => 'Upload file',
                                'external' => 'External URL',
                            ])
                            ->default('upload')
                            ->live()
                            ->dehydrated(false)
                            ->inline(false),
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

                Forms\Components\Section::make('Media')
                    ->schema([
                        MediaUpload::image('media_path', 'Image file')
                            ->visible(fn (Get $get): bool => $get('media_source') === 'upload' && $get('media_type') === GalleryItem::TYPE_IMAGE)
                            ->required(fn (Get $get): bool => $get('media_source') === 'upload' && $get('media_type') === GalleryItem::TYPE_IMAGE),

                        MediaUpload::video('media_path', 'Video file')
                            ->visible(fn (Get $get): bool => $get('media_source') === 'upload' && $get('media_type') === GalleryItem::TYPE_VIDEO)
                            ->required(fn (Get $get): bool => $get('media_source') === 'upload' && $get('media_type') === GalleryItem::TYPE_VIDEO),

                        Forms\Components\TextInput::make('media_url')
                            ->label('External URL')
                            ->url()
                            ->maxLength(2048)
                            ->visible(fn (Get $get): bool => $get('media_source') === 'external')
                            ->required(fn (Get $get): bool => $get('media_source') === 'external')
                            ->helperText('YouTube, Vimeo, or a direct image/video link.')
                            ->columnSpanFull(),
                    ]),

                LocaleFields::tabs(fn (string $locale) => [
                    LocaleFields::text('title', 'Title', $locale),
                ], 'Gallery text'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
                Tables\Columns\ImageColumn::make('media_path')
                    ->label('Preview')
                    ->disk('public_assets')
                    ->visible(fn (GalleryItem $record): bool => $record->isImage() && $record->usesUpload()),
                Tables\Columns\TextColumn::make('title')
                    ->formatStateUsing(fn (GalleryItem $record) => $record->getTranslation('title', 'en')),
                Tables\Columns\TextColumn::make('media_type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                Tables\Columns\TextColumn::make('media_url')
                    ->label('URL')
                    ->limit(40)
                    ->toggleable(),
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
            'index' => Pages\ListGalleryItems::route('/'),
            'create' => Pages\CreateGalleryItem::route('/create'),
            'edit' => Pages\EditGalleryItem::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
