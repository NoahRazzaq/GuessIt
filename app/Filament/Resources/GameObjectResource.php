<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameObjectResource\Pages;
use App\Filament\Resources\GameObjectResource\RelationManagers;
use App\Models\GameObject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GameObjectResource extends Resource
{
    protected static ?string $model = GameObject::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?string $navigationLabel = 'Objets Mystères';
    protected static ?string $pluralLabel = 'Objets Mystères';
    protected static ?string $slug = 'game-objects';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nom')
                ->required(),

            Textarea::make('description')
                ->label('Description'),

            Textarea::make('image_path')
                ->label('Image'),

            TextInput::make('real_price')
                ->label('Prix réel')
                ->numeric()
                ->required(),

            Select::make('category_id')
                ->label('Catégorie')
                ->relationship('category', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('image_path')
                    ->label('Image'),

                TextColumn::make('name')->label('Nom')->sortable()->searchable(),
                TextColumn::make('real_price')->label('Prix réel')->sortable(),
                TextColumn::make('category.name')->label('Catégorie')->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGameObjects::route('/'),
            'create' => Pages\CreateGameObject::route('/create'),
            'edit' => Pages\EditGameObject::route('/{record}/edit'),
        ];
    }
}
