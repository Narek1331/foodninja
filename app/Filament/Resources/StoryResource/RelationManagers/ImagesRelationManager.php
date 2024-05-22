<?php

namespace App\Filament\Resources\StoryResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

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
                            ->content('450x800')
                            ->columnSpan('full'),
                        Forms\Components\FileUpload::make('img_path')
                            ->label('Изображение')
                            ->directory('images')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*'])
                            ->requiredWithout('youtube_video_url'),
                        TextInput::make('youtube_video_url')
                            ->label('Изображение')
                            ->type('url')
                            ->label('Ссылка на видео на ютубе')
                            ->requiredWithout('img_path'),
                        TextInput::make('img_full_path')
                            ->type('text')
                            ->label('Ссылка'),
                        Forms\Components\Checkbox::make('show_description')
                            ->label('Добавить описание')
                            ->reactive(),
                        TextInput::make('title')
                            ->type('text')
                            ->label('Заголовок')
                            ->visible(fn ($get) => $get('show_description')),
                        TextInput::make('description')
                            ->type('text')
                            ->label('Описание')
                            ->visible(fn ($get) => $get('show_description')),
                    ])
                    ->columns(1),
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
                Tables\Columns\TextColumn::make('youtube_video_url')
                    ->label('Ссылка на видео на ютубе'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата')
                    ->sortable(),

            ])
            ->filters([

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
                    // Tables\Actions\ForceDeleteBulkAction::make()->label('Удалить навсегда'),
                ]),
            ])
            ->defaultSort('order_by', 'asc');
    }
}
