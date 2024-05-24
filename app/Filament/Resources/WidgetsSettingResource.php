<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WidgetsSettingResource\Pages;
use App\Models\WidgetsSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class WidgetsSettingResource extends Resource
{
    protected static ?string $model = WidgetsSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Виджеты';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $pluralLabel = 'Виджеты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Всплывающий виджет')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Toggle::make('turn_on')
                                            ->label('Включить?')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\Toggle::make('show_only_auth_users')
                                            ->label('Отображать только авторизованным пользователям')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('how_long_display')
                                            ->label('Через сколько отображать виджет (секунды)')
                                            ->numeric()
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('yes_button_text')
                                            ->label('Текст кнопки «Да»')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('cancel_button_text')
                                            ->label('Текст кнопки отмены')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('link_when_click_yes')
                                            ->label('Укажите ссылку, которая будет открываться при нажатии «Да»')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('heading')
                                            ->label('Заголовок')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('text_in_popup_window')
                                            ->label('Текст во всплывающем окне')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                        Forms\Components\Tabs\Tab::make('Мобильные приложения')
                            ->schema([
                                Forms\Components\Grid::make()
                                    ->schema([
                                        Forms\Components\Toggle::make('display_app_download_widget')
                                            ->label('Отображать над футером виджет скачивания приложения?')
                                            ->required()
                                            ->columnSpanFull(),
                                        Forms\Components\Toggle::make('display_popup_app_download_widget')
                                            ->label('Отображать всплывающий виджет скачивания приложения?')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('ID'),
                Tables\Columns\TextColumn::make('merchant_id')->label('Merchant ID'),
                Tables\Columns\TextColumn::make('turn_on')->label('Включить'),
                Tables\Columns\TextColumn::make('show_only_auth_users')->label('Отображать только авторизованным пользователям'),
                Tables\Columns\TextColumn::make('how_long_display')->label('Через сколько отображать виджет (секунды)'),
                Tables\Columns\TextColumn::make('yes_button_text')->label('Текст кнопки «Да»'),
                Tables\Columns\TextColumn::make('cancel_button_text')->label('Текст кнопки отмены'),
                Tables\Columns\TextColumn::make('link_when_click_yes')->label('Ссылка при нажатии «Да»'),
                Tables\Columns\TextColumn::make('heading')->label('Заголовок'),
                Tables\Columns\TextColumn::make('text_in_popup_window')->label('Текст во всплывающем окне'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            // Define your relations here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWidgetsSettings::route('/'),
            'create' => Pages\CreateWidgetsSetting::route('/create'),
            'edit' => Pages\EditWidgetsSetting::route('/{record}/edit'),
        ];
    }
}
