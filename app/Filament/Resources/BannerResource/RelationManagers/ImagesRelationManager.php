<?php

namespace App\Filament\Resources\BannerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Illuminate\Database\Eloquent\Model;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';
    protected static ?string $recordTitleAttribute = 'img_path';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'Настройки изображения';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('recommended_sizes')
                            ->label('Рекомендуемые размеры изображений:')
                            ->content('ПК: 1240x360 px, Мобильный: 910x480 px')
                            ->columnSpan('full'),
                        Forms\Components\FileUpload::make('img_path')
                            ->directory('images')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*'])
                            ->requiredWithout('img_full_path')
                            ->label('Загрузить изображение'),
                        TextInput::make('img_full_path')
                            ->type('url')
                            ->label('Установить URL изображения')
                            ->requiredWithout('img_path'),
                        Forms\Components\Checkbox::make('new_window')
                            ->label('Открыть в новом окне'),
                        TextInput::make('autoscroll_seconds')
                            ->type('number')
                            ->label('Секунды автопрокрутки')
                            ->required(),
                    ])
                    ->columns(1)
                    ->label('Настройки изображения'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('order_by')
            ->recordTitleAttribute('img_path')
            ->columns([
                Tables\Columns\ImageColumn::make('img_path')
                    ->label('Изображение')
                    ->size(150),
                Tables\Columns\BooleanColumn::make('new_window')
                    ->label('Открыть в новом окне'),
                Tables\Columns\TextColumn::make('order_by')
                    ->label('Порядок')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Добавить изображение'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Удалить выбранное'),
                ]),
            ])
            ->defaultSort('order_by', 'asc');
    }
}
