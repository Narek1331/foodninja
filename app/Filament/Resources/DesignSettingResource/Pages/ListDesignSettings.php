<?php

namespace App\Filament\Resources\DesignSettingResource\Pages;

use App\Filament\Resources\DesignSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Redirect;
use App\Models\WidgetsSetting;
use App\Models\DesignSetting\DesignSetting;

class ListDesignSettings extends ListRecords
{
    protected static string $resource = DesignSettingResource::class;

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
