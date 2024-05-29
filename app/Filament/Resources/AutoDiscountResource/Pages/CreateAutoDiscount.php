<?php

namespace App\Filament\Resources\AutoDiscountResource\Pages;

use App\Filament\Resources\AutoDiscountResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAutoDiscount extends CreateRecord
{
    protected static string $resource = AutoDiscountResource::class;

    public function getTitle(): string
    {
        return 'Создать Автоскидка';
    }
}
