<?php

namespace App\Filament\Resources\AdminGamesResource\Pages;

use App\Filament\Resources\AdminGamesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdminGames extends EditRecord
{
    protected static string $resource = AdminGamesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
