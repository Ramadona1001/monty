<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceRequestResource\Pages;
use App\Models\ServiceRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceRequestResource extends Resource
{
    protected static ?string $model = ServiceRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Inbox';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Service requests';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Request details')
                    ->schema([
                        Forms\Components\TextInput::make('customer_name')->disabled(),
                        Forms\Components\TextInput::make('phone')->disabled(),
                        Forms\Components\Placeholder::make('branch_label')
                            ->label('Branch')
                            ->content(fn (ServiceRequest $record): string => $record->branch?->getTranslation('name', 'en') ?? '—'),
                        Forms\Components\Placeholder::make('service_label')
                            ->label('Service type')
                            ->content(fn (ServiceRequest $record): string => $record->serviceRequestType?->getTranslation('name', 'en') ?? '—'),
                        Forms\Components\Placeholder::make('customer_type_label')
                            ->label('Customer category')
                            ->content(fn (ServiceRequest $record): string => match ($record->customer_type) {
                                ServiceRequest::TYPE_PROJECT => 'Projects',
                                default => 'Individuals',
                            }),
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
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->formatStateUsing(fn (ServiceRequest $record) => $record->branch?->getTranslation('name', 'en')),
                Tables\Columns\TextColumn::make('serviceRequestType.name')
                    ->label('Service')
                    ->formatStateUsing(fn (ServiceRequest $record) => $record->serviceRequestType?->getTranslation('name', 'en')),
                Tables\Columns\TextColumn::make('customer_type')
                    ->label('Category')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        ServiceRequest::TYPE_PROJECT => 'Projects',
                        default => 'Individuals',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        ServiceRequest::TYPE_PROJECT => 'info',
                        default => 'success',
                    }),
                Tables\Columns\IconColumn::make('is_read')->boolean(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read'),
                Tables\Filters\SelectFilter::make('customer_type')
                    ->label('Category')
                    ->options([
                        ServiceRequest::TYPE_INDIVIDUAL => 'Individuals',
                        ServiceRequest::TYPE_PROJECT => 'Projects',
                    ]),
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
            'index' => Pages\ListServiceRequests::route('/'),
            'view' => Pages\ViewServiceRequest::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
