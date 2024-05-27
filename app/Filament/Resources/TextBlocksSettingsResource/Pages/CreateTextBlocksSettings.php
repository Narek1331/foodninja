<?php

namespace App\Filament\Resources\TextBlocksSettingsResource\Pages;

use App\Filament\Resources\TextBlocksSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\CreateAction;

class CreateTextBlocksSettings extends CreateRecord
{
    protected static string $resource = TextBlocksSettingsResource::class;

    public function getTitle(): string
    {
        return 'Инф. Блоки';
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
