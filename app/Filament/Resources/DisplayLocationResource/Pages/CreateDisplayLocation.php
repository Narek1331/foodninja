<?php

namespace App\Filament\Resources\DisplayLocationResource\Pages;

use App\Filament\Resources\DisplayLocationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDisplayLocation extends CreateRecord
{
    protected static string $resource = DisplayLocationResource::class;

    public function getTitle(): string
    {
        return 'Создать места отображения';
    }
}
