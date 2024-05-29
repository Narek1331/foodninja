<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutoDiscountResource\Pages;
use App\Filament\Resources\AutoDiscountResource\RelationManagers;
use App\Models\Discount\AutoDiscount;
use App\Models\Delivery\DeliveryType;
use App\Models\Day;
use App\Models\DisplayLocation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Discount\DiscountType;
use Filament\Forms\Components\{
    Card,
    Checkbox,
    Fieldset,
    Radio,
    TextInput,
    Toggle,
    Tabs,
    View,
    Select,
    DatePicker,
    TimePicker,
    CheckboxList
};
use Filament\Tables\Columns\{
    TextColumn,
    BooleanColumn
};

class AutoDiscountResource extends Resource
{
    protected static ?string $model = AutoDiscount::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationLabel = 'Автоскидка';

    protected static ?string $navigationGroup = 'Маркетинг';

    protected static ?string $pluralLabel = 'Автоскидка';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()
                ->schema([
                    Fieldset::make()
                        ->schema([
                            TextInput::make('title')
                                ->label('Заголовок')
                                ->columnSpan('full'),
                        ]),
                    Fieldset::make('Условия действия скидки')
                        ->schema([
                            Toggle::make('status')
                                ->label('Статус')
                                ->columnSpan('full'),
                            Select::make('discount_type_id')
                                ->label('Тип скидки')
                                ->required()
                                ->default(DiscountType::first()->id ?? null)
                                ->options(DiscountType::all()->pluck('name', 'id'))
                                ->reactive()
                                ->afterStateUpdated(fn ($state, callable $set) => [
                                    $set('discount_label', DiscountType::find($state)?->name ?? 'Скидка в рублях'),
                                ])
                                ->columnSpan('full'),
                            TextInput::make('discount_value')
                                ->label(fn (callable $get) => $get('discount_label') ?? 'Скидка в рублях')
                                ->columnSpan('full'),
                            DatePicker::make('date_from')
                                ->label('Дата начала'),
                            DatePicker::make('date_to')
                                ->label('Дата окончания'),
                            // Select::make('')
                            //     ->label('Категории меню, участвующие в акции')
                            //     ->columnSpan('full'),
                            Toggle::make('exclude_listed_categories_promotion')
                                ->label('Исключить продвижение вложенных категорий')
                                ->columnSpan('full'),
                            Toggle::make('exclude_discounted_items')
                                ->label('Исключить товары со скидкой')
                                ->columnSpan('full'),
                            Toggle::make('strict_mode')
                                ->label('Строгий режим')
                                ->columnSpan('full'),
                                Fieldset::make('В какое время действует автоскидка')
                                ->schema([
                                    TimePicker::make('time_from')
                                        ->label('Время начала')
                                        ->withoutSeconds(),
                                    TimePicker::make('time_to')
                                        ->label('Время окончания')
                                        ->withoutSeconds(),
                                ])
                                ->columns(2)
                                ->columnSpan('full'),
                            CheckboxList::make('days')
                                    ->label('Дни действий')
                                    ->options(Day::all()->pluck('name', 'id'))
                                    ->relationship(titleAttribute: 'name')
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, $livewire, $set) {
                                        if ($livewire->record) {
                                            $livewire->record->days()->sync($state);
                                        }
                                    }),
                                Select::make('delivery_type_id')
                                ->label('Действует для')
                                ->required()
                                ->default(DeliveryType::first()->id ?? null)
                                ->options(DeliveryType::all()->pluck('name', 'id'))
                                ->reactive()
                                ->afterStateUpdated(fn (callable $set, $state) => [
                                    $set('delivery_start_from.hidden', $state == 2 || $state == 1 ? false : true),
                                    $set('pickup_start_from.hidden', $state == 3 || $state == 1 ? false : true),
                                ])
                                ->columnSpan('full'),

                            TextInput::make('delivery_start_from')
                                ->label('Действует на доставку от')
                                ->numeric()
                                ->hidden(fn (callable $get) => $get('delivery_start_from.hidden'))
                                // ->hidden(fn ($get) => $get('delivery_type_id') !== DeliveryType::where('name', 'Доставка')->first()->id && $get('delivery_type_id') !== DeliveryType::where('name', 'Самовывоз и доставка')->first()->id)
                                ->columnSpan('full'),

                            TextInput::make('pickup_start_from')
                                ->label('Действует на самовывоз от')
                                ->hidden(fn (callable $get) => $get('pickup_start_from.hidden'))
                                ->numeric()
                                // ->hidden(fn ($get) => $get('delivery_type_id') !== DeliveryType::where('name', 'Самовывоз')->first()->id && $get('delivery_type_id') !== DeliveryType::where('name', 'Самовывоз и доставка')->first()->id)
                                ->columnSpan('full'),
                            CheckboxList::make('displayLocations')
                                ->label('Платформа')
                                ->options(DisplayLocation::all()->pluck('name', 'id'))
                                ->relationship(titleAttribute: 'name')
                                ->reactive()
                                ->afterStateUpdated(function ($state, $livewire, $set) {
                                    if ($livewire->record) {
                                        $livewire->record->displayLocations()->sync($state);
                                    }
                                }),
                            Toggle::make('use_gift')
                                ->label('Разрешить использование с подарками')
                                ->columnSpan('full'),
                            Toggle::make('use_promotional_code')
                                ->label('Разрешить использование с промокодами')
                                ->columnSpan('full'),
                        ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_by')
            ->columns([
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
                BooleanColumn::make('status')
                    ->label('Статус'),
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
            ])
            ->defaultSort('order_by', 'asc');
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
            'index' => Pages\ListAutoDiscounts::route('/'),
            'create' => Pages\CreateAutoDiscount::route('/create'),
            'edit' => Pages\EditAutoDiscount::route('/{record}/edit'),
        ];
    }

}
