<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('property_id')
                    ->label('Property')
                    ->relationship('property', 'name')
                    ->required()
                    ->searchable()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $property = Property::find($state);
                            $set('price_per_night', $property->price_per_night);
                        }
                    }),
                
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->minDate(now())
                    ->afterStateUpdated(function ($state, $set, $get) {
                        if ($state && $get('end_date')) {
                            $start = \Carbon\Carbon::parse($state);
                            $end = \Carbon\Carbon::parse($get('end_date'));
                            $nights = $end->diffInDays($start);
                            $price_per_night = $get('price_per_night');
                            $set('total_price', $nights * $price_per_night);
                        }
                    }),
                
                Forms\Components\DatePicker::make('end_date')
                    ->required()
                    ->minDate(fn (Forms\Get $get) => $get('start_date'))
                    ->afterStateUpdated(function ($state, $set, $get) {
                        if ($state && $get('start_date')) {
                            $start = \Carbon\Carbon::parse($get('start_date'));
                            $end = \Carbon\Carbon::parse($state);
                            $nights = $end->diffInDays($start);
                            $price_per_night = $get('price_per_night');
                            $set('total_price', $nights * $price_per_night);
                        }
                    }),
                
                Forms\Components\Hidden::make('price_per_night'),
                
                Forms\Components\TextInput::make('total_price')
                    ->numeric()
                    ->required()
                    ->prefix('€')
                    ->disabled()
                    ->dehydrated(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('property.name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('total_price')
                    ->money('EUR', locale: 'fr') // Format monétaire européen
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('property')
                    ->relationship('property', 'name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
