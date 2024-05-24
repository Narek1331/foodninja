<?php

namespace App\Filament\Resources\TextBlocksSettingsResource\Pages;

use App\Filament\Resources\TextBlocksSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTextBlocksSettings extends EditRecord
{
    protected static string $resource = TextBlocksSettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Редактирование Инф. блок';
    }
}
