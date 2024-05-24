<?php

namespace App\Filament\Resources\WidgetsSettingResource\Pages;

use App\Filament\Resources\WidgetsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateWidgetsSetting extends CreateRecord
{
    protected static string $resource = WidgetsSettingResource::class;

    public function getTitle(): string
    {
        return 'Создать';
    }
}
