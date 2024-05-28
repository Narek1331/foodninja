<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BonusProgramSettingResource\Pages;
use App\Filament\Resources\BonusProgramSettingResource\RelationManagers;
use App\Models\BonusProgramSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{
    Card, Checkbox, Fieldset, MultiSelect, Radio, TextInput, Toggle, Tabs, View
};

class BonusProgramSettingResource extends Resource
{
    protected static ?string $model = BonusProgramSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Бонусная программа';

    protected static ?string $navigationGroup = 'Маркетинг';

    protected static ?string $pluralLabel = 'Бонусная программа';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make([
                Fieldset::make('Общие настройки')
                    ->schema([
                        Toggle::make('status')
                            ->label('Статус')
                            ->onIcon('heroicon-s-check')
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false),
                        Radio::make('expire')
                            ->label('Срок действия бонусов')
                            ->default('infinity')
                            ->options([
                                'infinity' => 'Бессрочно',
                                'reset' => 'Сгорают каждое 1-ое число сезона: 1 марта, 1 июня, 1 сентября, 1 декабря',
                            ]),
                    ]),

                Fieldset::make('Настройки бонусов')
                ->schema([
                    View::make('filament.components.bonus-info'),

                ]),

                Tabs::make('Детали бонусной программы')
                    ->tabs([
                        Tabs\Tab::make('Начисление')
                            ->schema([
                                TextInput::make('delivery_percent')
                                    ->label('% кешбэка на доставку')
                                    ->numeric()
                                    ->suffix('%'),
                                TextInput::make('self_delivery_percent')
                                    ->label('% кешбэка навынос')
                                    ->numeric()
                                    ->suffix('%'),
                                TextInput::make('registration_bonus')
                                    ->label('Бонусы новому клиенту за регистрацию')
                                    ->numeric(),
                                TextInput::make('birthday_bonus')
                                    ->label('Бонусы клиенту в день рождения')
                                    ->numeric(),
                                Checkbox::make('allow_sale_product')
                                    ->label('Начислять бонусы за товары со скидкой')
                                    ->inline(false),
                                Checkbox::make('allow_promocode')
                                    ->label('Начислять бонусы, если в заказе есть промокод')
                                    ->inline(false),
                                Checkbox::make('allow_bonus_product')
                                    ->label('Начислять бонусы, если в заказе есть подарок')
                                    ->inline(false),
                                Checkbox::make('allow_with_bonuses')
                                    ->label('Начислять бонусы при оплате заказа бонусами')
                                    ->inline(false),
                                // MultiSelect::make('categories')
                                //     ->relationship('category', 'name')
                                //     ->label('Выбор или запрет определенных категорий для начисления бонусов'),
                                Checkbox::make('exclude_categories')
                                    ->label('Исключить категории указанные выше')
                                    ->helperText('Бонусы начисляются только за товары из определенных категорий меню в заказе. Можно выбирать или исключать категории.')
                                    ->inline(false),
                            ]),
                            Tabs\Tab::make('Списание')
                            ->schema([
                                TextInput::make('payment_percent')
                                    ->label('Какой % от суммы заказа клиент может оплатить бонусами')
                                    ->numeric()
                                    ->suffix('%'),
                                Checkbox::make('payment_ignore_minimal_price')
                                    ->label('Игнорировать минимальную сумму заказа')
                                    ->inline(false),
                                Checkbox::make('payment_ignore_delivery_price')
                                    ->label('Бесплатная доставка при списании бонусов')
                                    ->helperText('Цена доставки не будет добавляться, если при списании бонусов сумма заказа стала меньше порога бесплатной доставки.')
                                    ->inline(false),
                                Checkbox::make('payment_disable_with_promocode')
                                    ->label('Запретить оплату бонусами, если в заказе есть промокод')
                                    ->inline(false),
                                Checkbox::make('payment_disable_with_bonus_product')
                                    ->label('Запретить оплату бонусами, если в заказе есть подарок')
                                    ->inline(false),
                                Checkbox::make('payment_disable_with_sale_product')
                                    ->label('Запретить оплату бонусами, если в заказе есть товар со скидкой')
                                    ->inline(false),
                                // MultiSelect::make('payment_categories')
                                //     ->relationship('category', 'name')
                                //     ->label('Выбор или запрет определенных категорий для оплаты бонусами'),
                                Checkbox::make('payment_exclude_categories')
                                    ->label('Исключить категории указанные выше')
                                    ->helperText('Бонусы списываются, если в корзине только товары из выбранных категорий.
                                    При исключении категорий бонусы списываются, если в корзине нет ни одного товара из исключенных категорий.')
                                    ->inline(false),
                            ]),
                    ]),
            ])
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
            'index' => Pages\ListBonusProgramSettings::route('/'),
            'create' => Pages\CreateBonusProgramSetting::route('/create'),
            'edit' => Pages\EditBonusProgramSetting::route('/{record}/edit'),
        ];
    }
}
