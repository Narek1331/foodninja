<?php

namespace App\Filament\Resources\CounterAndFeedResource\Pages;

use App\Filament\Resources\CounterAndFeedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Redirect;
use App\Models\CounterAndFeed;

class ListCounterAndFeeds extends ListRecords
{
    protected static string $resource = CounterAndFeedResource::class;

    public function mount(): void
    {
        if (CounterAndFeed::count() > 0) {
            $firstRecordId = CounterAndFeed::first()->id;
            Redirect::to(static::getResource()::getUrl('edit', ['record' => $firstRecordId]));
        } else {
            Redirect::to(static::getResource()::getUrl('create'));
        }
    }

}
