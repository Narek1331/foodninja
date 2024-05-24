<?php

namespace App\Filament\Resources\WidgetsSettingResource\Pages;

use App\Filament\Resources\WidgetsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWidgetsSetting extends EditRecord
{
    protected static string $resource = WidgetsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Редактирование';
    }
}
