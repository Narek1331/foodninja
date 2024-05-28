<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DesignSettingResource\Pages;
use App\Filament\Resources\DesignSettingResource\RelationManagers;
use App\Models\DesignSetting\DesignSetting;
use App\Models\DesignSetting\DesignSettingParam;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Radio;
use App\Filament\Components\RadioImageField;

class DesignSettingResource extends Resource
{
    protected static ?string $model = DesignSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Дизайн';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $pluralLabel = 'Дизайн';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Настройки')
                    ->tabs([
                        Tabs\Tab::make('Основные настройки')->schema([
                            ColorPicker::make('main_color')->label('Основной цвет'),
                            ColorPicker::make('secondary_color')->label('Дополнительный цвет'),
                            Toggle::make('dark_theme')
                                ->default(false)
                                ->label('Темная тема'),
                            Toggle::make('full_width')
                                ->default(false)
                                ->label('Макет на всю ширину'),
                            Toggle::make('header_new_version')
                                ->default(false)
                                ->label('Использовать новую версию шапки'),
                            ColorPicker::make('background')->label('Цвет фона'),
                            Toggle::make('use_colors_for_admin_panel')
                                ->default(false)
                                ->label('Использовать цвета для админ-панели'),
                            Toggle::make('modal_close_only_by_cross')
                                ->default(false)
                                ->label('Закрывать модальное окно только крестиком'),
                            Select::make('font_id')
                                ->label('Шрифт сайта')
                                ->required()
                                ->default(DesignSettingParam::where('type', 'website_font')
                                ->where('name', 'Nunito')
                                ->first()->id ?? null)
                                ->options(DesignSettingParam::where('type','website_font')
                                ->get()
                                ->pluck('name', 'id')),
                            FileUpload::make('favicon_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/favicon";
                                })
                                ->label('Фавикон'),
                            FileUpload::make('logo_light_background_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/logo-light-background";
                                })
                                ->label('Логотип на светлом фоне'),
                            FileUpload::make('logo_dark_background_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/logo-dark-background";
                                })
                                ->label('Логотип на темном фоне'),
                            FileUpload::make('og_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/og";
                                })
                                ->label('OG изображение для социальных сетей'),
                        ]),
                        Tabs\Tab::make('Технические изображения')->schema([
                            FileUpload::make('empty_cart_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/empty-cart";
                                })
                                ->label('Изображение пустой корзины'),
                            FileUpload::make('checkout_success_page_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/checkout-success";
                                })
                                ->label('Изображение успешного оформления заказа'),
                            FileUpload::make('checkout_error_page_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/checkout-error";
                                })
                                ->label('Изображение ошибки при оформлении заказа'),
                            FileUpload::make('modal_off_hours_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/modal-off-hours";
                                })
                                ->label('Изображение для модального окна в нерабочее время'),
                            FileUpload::make('modal_disabled_platform_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/modal-disabled-platform";
                                })
                                ->label('Изображение для модального окна при отключении платформы'),
                            FileUpload::make('error_occurs_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/error-occurs";
                                })
                                ->label('Изображение при возникновении ошибки'),
                            FileUpload::make('free_soy_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/free-soy";
                                })
                                ->label('Изображение бесплатного соевого соуса'),
                            FileUpload::make('free_wasabi_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/free-wasabi";
                                })
                                ->label('Изображение бесплатного васаби'),
                            FileUpload::make('free_ginger_img_path')
                                ->directory(function () {
                                    $merchantId = auth()->user()->merchantId();
                                    return "{$merchantId}/design/free_ginger";
                                })
                                ->label('Изображение бесплатного имбиря'),
                        ]),
                        Tabs\Tab::make('Шапка')->schema([
                            RadioImageField::make('cap_id')
                                ->options(DesignSettingParam::where('type', 'cap')->get()->toArray())
                                ->label('Choose an Option')
                                ->columnSpan('full'),
                        ]),
                        Tabs\Tab::make('Мобильное меню')->schema([
                            RadioImageField::make('mobile_menu_id')
                            ->options(DesignSettingParam::where('type','mobile_menu')->get()->toArray())
                            ->label('Choose an Option')
                            ->columnSpan('full'),
                        ]),
                        Tabs\Tab::make('Баннеры')->schema([
                            RadioImageField::make('banner_id')
                            ->options(DesignSettingParam::where('type','banner')->get()->toArray())
                            ->label('Choose an Option')
                            ->columnSpan('full'),
                        ]),
                        Tabs\Tab::make('Меню категорий')->schema([
                            RadioImageField::make('category_menu_id')
                            ->options(DesignSettingParam::where('type','category_menu')->get()->toArray())
                            ->label('Choose an Option')
                            ->columnSpan('full'),
                        ]),
                        Tabs\Tab::make('Товары')->schema([
                            RadioImageField::make('product_id')
                            ->options(DesignSettingParam::where('type','product')->get()->toArray())
                            ->columnSpan('full'),
                        Select::make('discount_sticker_on_goods')
                            ->label('Стикер скидки на товарах')
                            ->options([
                                '1' => 'Отображать',
                                '0' => 'Скрыть',
                            ])
                            ->default('0'),
                         TextInput::make('add_to_cart_button_text')
                            ->label('Текст кнопки добавления товара в корзину'),
                        ColorPicker::make('product_image_background')
                            ->label('Залить фон изображения товаров	'),
                        Toggle::make('stretch_photo_width')
                            ->default(false)
                            ->label('Растянуть фото по ширине?'),
                        Toggle::make('crop_photo_height')
                            ->default(false)
                            ->label('Обрезать фото по высоте до пропорции 16:11'),
                        Select::make('product_variation_id')
                            ->label('Отображение вариаций у товара')
                            ->required()
                            ->default(DesignSettingParam::where('type', 'displaying_product_variations')
                            ->where('name', 'Вертикально')
                            ->first()->id ?? null)
                            ->options(DesignSettingParam::where('type','displaying_product_variations')
                            ->get()
                            ->pluck('name', 'id')),
                        ]),
                        Tabs\Tab::make('Подвал')->schema([
                            RadioImageField::make('footer_id')
                            ->options(DesignSettingParam::where('type','footer')->get()->toArray())
                            ->columnSpan('full'),
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
            'index' => Pages\ListDesignSettings::route('/'),
            'create' => Pages\CreateDesignSetting::route('/create'),
            'edit' => Pages\EditDesignSetting::route('/{record}/edit'),
        ];
    }

}
