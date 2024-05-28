<?php

namespace App\Filament\Resources\CounterAndFeedResource\Pages;

use App\Filament\Resources\CounterAndFeedResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Pages\Actions\CreateAction;

class CreateCounterAndFeed extends CreateRecord
{
    protected static string $resource = CounterAndFeedResource::class;

    public function getTitle(): string
    {
        return 'Счетчики и фиды';
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [
            CreateAction::make()
                ->label('Сохранить')
                ->action('create'),
        ];
    }
}
