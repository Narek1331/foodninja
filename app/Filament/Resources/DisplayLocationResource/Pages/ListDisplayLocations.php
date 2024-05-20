<?php

namespace App\Filament\Resources\DisplayLocationResource\Pages;

use App\Filament\Resources\DisplayLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisplayLocations extends ListRecords
{
    protected static string $resource = DisplayLocationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
