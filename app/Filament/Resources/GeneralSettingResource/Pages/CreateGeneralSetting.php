<?php

namespace App\Filament\Resources\GeneralSettingResource\Pages;

use App\Filament\Resources\GeneralSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\CreateAction;

class CreateGeneralSetting extends CreateRecord
{
    protected static string $resource = GeneralSettingResource::class;

    public function getTitle(): string
    {
        return 'Общие';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [
            CreateAction::make()
                ->label('Сохранить')
                ->action('create'),
        ];
    }
}
