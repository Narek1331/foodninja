<?php

namespace App\Filament\Resources\DisplayLocationResource\Pages;

use App\Filament\Resources\DisplayLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDisplayLocation extends EditRecord
{
    protected static string $resource = DisplayLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
