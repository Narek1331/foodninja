<?php

namespace App\Filament\Resources\TextBlocksSettingsResource\Pages;

use App\Filament\Resources\TextBlocksSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;

class EditTextBlocksSettings extends EditRecord
{
    protected static string $resource = TextBlocksSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

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
            ButtonAction::make('save')
                ->label('Сохранить')
                ->action('save'),
        ];
    }
}
