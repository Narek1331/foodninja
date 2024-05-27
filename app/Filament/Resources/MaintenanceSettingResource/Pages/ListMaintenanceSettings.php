<?php

namespace App\Filament\Resources\MaintenanceSettingResource\Pages;

use App\Filament\Resources\MaintenanceSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Models\Maintenance\MaintenanceSetting;
use Illuminate\Support\Facades\Redirect;

class ListMaintenanceSettings extends ListRecords
{
    protected static string $resource = MaintenanceSettingResource::class;

    public function mount(): void
    {
        if (MaintenanceSetting::count() > 0) {
            // Redirect to the edit page of the first record
            $firstRecordId = MaintenanceSetting::first()->id;
            Redirect::to(static::getResource()::getUrl('edit', ['record' => $firstRecordId]));
        } else {
            // Redirect to the create page
            Redirect::to(static::getResource()::getUrl('create'));
        }
    }
}
