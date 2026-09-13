<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopRequestResource\Pages;
use App\Models\ShopRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ShopRequestResource extends Resource
{
    protected static ?string $model = ShopRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Inbox';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationLabel = 'Shop requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Request details')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')->disabled(),
                        Forms\Components\TextInput::make('phone')->disabled(),
                        Forms\Components\Placeholder::make('product_label')
                            ->label('Product')
                            ->content(fn (ShopRequest $record): string => $record->product?->getTranslation('title', 'en') ?? '—'),
                        Forms\Components\DateTimePicker::make('created_at')->disabled(),
                        Forms\Components\Textarea::make('notes')
                            ->disabled()
                            ->rows(5)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_read')
                            ->label('Mark as read'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('product.title')
                    ->label('Product')
                    ->formatStateUsing(fn (ShopRequest $record): string => $record->product?->getTranslation('title', 'en') ?? '—'),
                Tables\Columns\IconColumn::make('is_read')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListShopRequests::route('/'),
            'view' => Pages\ViewShopRequest::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
