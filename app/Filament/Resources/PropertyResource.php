<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    // Définit le modèle associé à cette ressource
    protected static ?string $model = Property::class;

    // Définit l'icône à afficher dans le menu de navigation
    protected static ?string $navigationIcon = 'heroicon-o-home';

    // Définit le formulaire pour créer/éditer une propriété
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Champ texte pour le nom de la propriété
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                // Champ textarea pour la description
                Forms\Components\Textarea::make('description')
                    ->required(),
                // Champ texte numérique pour le prix par nuit
                Forms\Components\TextInput::make('price_per_night')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
            ]);
    }

    // Définit le tableau listant les propriétés
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Colonne pour le nom
                Tables\Columns\TextColumn::make('name'),
                // Colonne pour le prix, formaté comme monnaie
                Tables\Columns\TextColumn::make('price_per_night')
                    ->money('EUR'),
                // Colonne pour la date de création
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                // Filtres (vide ici)
            ])
            ->actions([
                // Actions disponibles pour chaque ligne du tableau
                Tables\Actions\EditAction::make(),  // Bouton d'édition
                Tables\Actions\DeleteAction::make(),  // Bouton de suppression
            ])
            ->bulkActions([
                // Actions disponibles pour plusieurs lignes sélectionnées
                Tables\Actions\DeleteBulkAction::make(),  // Suppression en masse
            ]);
    }
    
    // Définit les relations à afficher
    public static function getRelations(): array
    {
        return [
            // Relations (vide ici)
        ];
    }
    
    // Définit les pages de cette ressource
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),  // Page de liste
            'create' => Pages\CreateProperty::route('/create'),  // Page de création
            'edit' => Pages\EditProperty::route('/{record}/edit'),  // Page d'édition
        ];
    }    
}
