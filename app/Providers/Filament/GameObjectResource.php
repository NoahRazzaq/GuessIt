<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GameObjectResource\Pages;
use App\Models\GameObject;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

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

            FileUpload::make('image_path')
                ->label('Image')
                ->disk('s3') // ou 'minio' si tu l’as renommé ainsi
                ->directory('objects')
                ->image()
                ->preserveFilenames()
                ->required(),

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
                ImageColumn::make('image_path')
                    ->disk('s3')
                    ->label('Image')
                    ->square()
                    ->height(60),

                TextColumn::make('name')->label('Nom')->sortable()->searchable(),

                TextColumn::make('real_price')
                    ->label('Prix réel')
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->sortable(),
            ])
            ->filters([])
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
