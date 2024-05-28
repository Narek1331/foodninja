<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TextBlocksSettingsResource\Pages;
use App\Models\TextBlocksSettings;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TextBlocksSettingsResource extends Resource
{
    protected static ?string $model = TextBlocksSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static ?string $navigationLabel = 'Инф. блоки';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $pluralLabel = 'Инф. блоки';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                RichEditor::make('mobile_install_text')
                ->label('Текст предлагающий установить мобильное приложение')
                ->columnSpan('full'),
                RichEditor::make('cart_hint')
                ->label('Подсказка в корзине')
                ->columnSpan('full'),
                RichEditor::make('hint_choosing_delivery')
                ->label('Подсказка при выборе доставки')
                ->columnSpan('full'),
                RichEditor::make('pre_order_hint')
                ->label('Подсказка для предзаказов')
                ->columnSpan('full'),
                RichEditor::make('site_footer_text')
                ->label('Текст в подвале сайта')
                ->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mobile_install_text')
                ->label('Текст предлагающий установить мобильное приложение')
                ->limit(50),
                Tables\Columns\TextColumn::make('cart_hint')
                ->label('Подсказка в корзине')
                ->limit(50),
                Tables\Columns\TextColumn::make('hint_choosing_delivery')
                ->label('Подсказка при выборе доставки')
                ->limit(50),
                Tables\Columns\TextColumn::make('pre_order_hint')
                ->label('Подсказка для предзаказов')
                ->limit(50),
                Tables\Columns\TextColumn::make('site_footer_text')
                ->label('Текст в подвале сайта')
                ->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTextBlocksSettings::route('/'),
            'create' => Pages\CreateTextBlocksSettings::route('/create'),
            'edit' => Pages\EditTextBlocksSettings::route('/{record}/edit'),
        ];
    }
}
