<?php

namespace App\Filament\Resources\GuessResource\Pages;

use App\Filament\Resources\GuessResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuess extends EditRecord
{
    protected static string $resource = GuessResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
