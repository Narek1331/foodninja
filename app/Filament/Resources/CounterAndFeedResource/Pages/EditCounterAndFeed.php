<?php

namespace App\Filament\Resources\CounterAndFeedResource\Pages;

use App\Filament\Resources\CounterAndFeedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;

class EditCounterAndFeed extends EditRecord
{
    protected static string $resource = CounterAndFeedResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }

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
            ButtonAction::make('save')
                ->label('Сохранить')
                ->action('save'),
        ];
    }
}
