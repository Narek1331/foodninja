<?php

namespace App\Filament\Resources\WidgetsSettingResource\Pages;

use App\Filament\Resources\WidgetsSettingResource;
use App\Models\WidgetsSetting;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Redirect;

class ListWidgetsSettings extends ListRecords
{
    protected static string $resource = WidgetsSettingResource::class;

    public function mount(): void
    {
        if (WidgetsSetting::count() > 0) {
            // Redirect to the edit page of the first record
            $firstRecordId = WidgetsSetting::first()->id;
            Redirect::to(static::getResource()::getUrl('edit', ['record' => $firstRecordId]));
        } else {
            // Redirect to the create page
            Redirect::to(static::getResource()::getUrl('create'));
        }
    }
}
