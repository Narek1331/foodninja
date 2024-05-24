<?php

namespace App\Filament\Resources\TextBlocksSettingsResource\Pages;

use App\Filament\Resources\TextBlocksSettingsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTextBlocksSettings extends CreateRecord
{
    protected static string $resource = TextBlocksSettingsResource::class;

    public function getTitle(): string
    {
        return 'Создать';
    }


}
