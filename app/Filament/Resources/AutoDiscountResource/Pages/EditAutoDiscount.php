<?php

namespace App\Filament\Resources\AutoDiscountResource\Pages;

use App\Filament\Resources\AutoDiscountResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAutoDiscount extends EditRecord
{
    protected static string $resource = AutoDiscountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string
    {
        $displayLocationName = $this->record->title ?? '';

        return $displayLocationName ? 'Редактирование ' . $displayLocationName : 'Редактирование';
    }

}
