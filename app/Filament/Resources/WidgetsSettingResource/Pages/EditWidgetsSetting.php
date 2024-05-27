<?php

namespace App\Filament\Resources\WidgetsSettingResource\Pages;

use App\Filament\Resources\WidgetsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;

class EditWidgetsSetting extends EditRecord
{
    protected static string $resource = WidgetsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

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
            ButtonAction::make('save')
                ->label('Сохранить')
                ->action('save'),
        ];
    }

}
