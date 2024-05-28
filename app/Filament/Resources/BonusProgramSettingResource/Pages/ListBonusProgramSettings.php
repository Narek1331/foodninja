<?php

namespace App\Filament\Resources\BonusProgramSettingResource\Pages;

use App\Filament\Resources\BonusProgramSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Redirect;
use App\Models\BonusProgramSetting;

class ListBonusProgramSettings extends ListRecords
{
    protected static string $resource = BonusProgramSettingResource::class;

    public function mount(): void
    {
        if (BonusProgramSetting::count() > 0) {
            $firstRecordId = BonusProgramSetting::first()->id;
            Redirect::to(static::getResource()::getUrl('edit', ['record' => $firstRecordId]));
        } else {
            Redirect::to(static::getResource()::getUrl('create'));
        }
    }
}
