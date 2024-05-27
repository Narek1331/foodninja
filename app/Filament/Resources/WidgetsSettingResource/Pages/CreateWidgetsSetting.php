<?php

namespace App\Filament\Resources\WidgetsSettingResource\Pages;

use App\Filament\Resources\WidgetsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\CreateAction;

class CreateWidgetsSetting extends CreateRecord
{
    protected static string $resource = WidgetsSettingResource::class;

    public function getTitle(): string
    {
        return 'Виджеты';
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
