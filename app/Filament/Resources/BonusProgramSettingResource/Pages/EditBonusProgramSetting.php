<?php

namespace App\Filament\Resources\BonusProgramSettingResource\Pages;

use App\Filament\Resources\BonusProgramSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;

class EditBonusProgramSetting extends EditRecord
{
    protected static string $resource = BonusProgramSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

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
            ButtonAction::make('save')
                ->label('Сохранить')
                ->action('save'),
        ];
    }
}
