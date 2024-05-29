<?php

namespace App\Filament\Resources\AutoDiscountResource\Pages;

use App\Filament\Resources\AutoDiscountResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAutoDiscounts extends ListRecords
{
    protected static string $resource = AutoDiscountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
