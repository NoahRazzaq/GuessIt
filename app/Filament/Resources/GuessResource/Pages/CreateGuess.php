<?php

namespace App\Filament\Resources\GuessResource\Pages;

use App\Filament\Resources\GuessResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuess extends CreateRecord
{
    protected static string $resource = GuessResource::class;
}
