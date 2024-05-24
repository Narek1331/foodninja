<?php

namespace App\Filament\Resources\TextBlocksSettingsResource\Pages;

use App\Filament\Resources\TextBlocksSettingsResource;
use App\Models\TextBlocksSettings;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Redirect;

class ListTextBlocksSettings extends ListRecords
{
    protected static string $resource = TextBlocksSettingsResource::class;

    public function mount(): void
    {
        if (TextBlocksSettings::count() > 0) {
            // Redirect to the edit page of the first record
            $firstRecordId = TextBlocksSettings::first()->id;
            Redirect::to(static::getResource()::getUrl('edit', ['record' => $firstRecordId]));
        } else {
            // Redirect to the create page
            Redirect::to(static::getResource()::getUrl('create'));
        }
    }
}
