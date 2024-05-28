<?php

namespace App\Filament\Resources\BonusProgramSettingResource\Pages;

use App\Filament\Resources\BonusProgramSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\CreateAction;

class CreateBonusProgramSetting extends CreateRecord
{
    protected static string $resource = BonusProgramSettingResource::class;

    public function getTitle(): string
    {
        return 'Бонусная Программа';
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
