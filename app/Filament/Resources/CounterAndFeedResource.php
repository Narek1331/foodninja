<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CounterAndFeedResource\Pages;
use App\Filament\Resources\CounterAndFeedResource\RelationManagers;
use App\Models\CounterAndFeed;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\View;

class CounterAndFeedResource extends Resource
{
    protected static ?string $model = CounterAndFeed::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Счетчики и фиды';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $pluralLabel = 'Счетчики и фиды';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Analytics and Feeds')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Счетчики')
                        ->schema([
                            Forms\Components\Textarea::make('yandex_metrics_code')
                                ->label('Код Яндекс метрики')
                                ->rows(5),
                            Forms\Components\TextInput::make('yandex_metrica_counter_id')
                                ->label('ID счетчика Яндекс метрики')
                                ->helperText('Цели javascript-событий (по идентификатору):
                                click_phone - Клик по номеру телефона
                                click_ios - Клик по ссылке на приложение IOS
                                click_android - Клик по ссылке на приложение Android
                                add_to_cart - Добавление товара в корзину
                                view_product - Просмотр товара
                                view_cart - Просмотр корзины
                                checkout - Начало оформления заказа
                                make_order - Заказ оформлен'
                            ),
                            Forms\Components\Textarea::make('google_analytics_code')
                                ->label('Код Google Analytics')
                                ->rows(5),
                            Forms\Components\Textarea::make('vk_code_pixel')
                                ->label('Код ВКонтакте Pixel')
                                ->rows(5),
                            Forms\Components\TextInput::make('vk_price_list_id')
                                ->label('ID прайс-листа ВКонтакте'),
                            Forms\Components\Textarea::make('facebook_pixel_code')
                                ->label('Код Facebook Pixel')
                                ->rows(5),
                            Forms\Components\Textarea::make('tiktok_pixel_code')
                                ->label('Код TikTok Pixel')
                                ->rows(5),
                        ]),
                    Forms\Components\Tabs\Tab::make('Фиды товаров')
                        ->schema([
                            View::make('filament.components.feeds-info'),

                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCounterAndFeeds::route('/'),
            'create' => Pages\CreateCounterAndFeed::route('/create'),
            'edit' => Pages\EditCounterAndFeed::route('/{record}/edit'),
        ];
    }
}
