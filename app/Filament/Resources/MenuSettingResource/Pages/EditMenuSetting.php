<?php

namespace App\Filament\Resources\MenuSettingResource\Pages;

use App\Filament\Resources\MenuSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;

class EditMenuSetting extends EditRecord
{
    protected static string $resource = MenuSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

    public function getTitle(): string
    {
        return $this->record->name ?? '';
    }

    // public function getBreadcrumbs(): array
    // {
    //     return [

    //     ];
    // }

    protected function getFormActions(): array
    {
        return [];
    }
}
