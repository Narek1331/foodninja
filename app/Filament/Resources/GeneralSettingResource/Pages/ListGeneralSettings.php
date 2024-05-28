<?php

namespace App\Filament\Resources\GeneralSettingResource\Pages;

use App\Filament\Resources\GeneralSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Redirect;
use App\Models\GeneralSetting;

class ListGeneralSettings extends ListRecords
{
    protected static string $resource = GeneralSettingResource::class;

    public function mount(): void
    {
        if (GeneralSetting::count() > 0) {
            $firstRecordId = GeneralSetting::first()->id;
            Redirect::to(static::getResource()::getUrl('edit', ['record' => $firstRecordId]));
        } else {
            Redirect::to(static::getResource()::getUrl('create'));
        }

    }
}
