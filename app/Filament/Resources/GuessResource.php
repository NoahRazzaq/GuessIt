<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuessResource\Pages;
use App\Filament\Resources\GuessResource\RelationManagers;
use App\Models\Guess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
class GuessResource extends Resource
{
    protected static ?string $model = Guess::class;

   
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Tentatives';
    protected static ?string $pluralLabel = 'Guess';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->relationship('user', 'name')
                ->label('Utilisateur')
                ->required(),

            Select::make('object_id')
                ->relationship('object', 'name')
                ->label('Objet')
                ->required(),

            TextInput::make('guessed_price')->label('Prix deviné')->numeric()->required(),
            TextInput::make('score')->label('Score')->numeric()->required(),
            TextInput::make('time_taken')->label('Temps (s)')->numeric()->nullable(),
            TextInput::make('attempt_number')->label('Tentative')->numeric()->default(1),

            Textarea::make('feedback')->label('Feedback')->nullable(),

            FileUpload::make('image_path')
                ->label('Image')
                ->disk('s3')
                ->directory('guesses')
                ->image()
                ->preserveFilenames()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Utilisateur'),
                TextColumn::make('object.name')->label('Objet'),
                TextColumn::make('guessed_price')->label('Prix deviné'),
                TextColumn::make('score')->label('Score'),
                TextColumn::make('attempt_number')->label('Tentative'),
                ImageColumn::make('image_path')->disk('s3')->label('Image'),
                TextColumn::make('created_at')->label('Date')->dateTime('d/m/Y H:i'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuesses::route('/'),
            'create' => Pages\CreateGuess::route('/create'),
            'edit' => Pages\EditGuess::route('/{record}/edit'),
        ];
    }
}
