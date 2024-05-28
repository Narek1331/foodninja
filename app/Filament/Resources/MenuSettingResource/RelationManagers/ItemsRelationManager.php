<?php

namespace App\Filament\Resources\MenuSettingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\CheckboxColumn;
use Illuminate\Database\Eloquent\Model;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'Структура меню';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('url')
                    ->label('URL')
                    ->type('url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('link_text')
                    ->label('Текст ссылки')
                    ->maxLength(255),
                Forms\Components\Checkbox::make('new_window')
                    ->label('Открыть в новом окне'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('order_by')
            ->recordTitleAttribute('url')
            ->columns([
                Tables\Columns\TextColumn::make('url')
                    ->label('URL'),
                Tables\Columns\TextColumn::make('link_text')
                    ->label('Текст ссылки'),
                Tables\Columns\BooleanColumn::make('new_window')
                    ->label('Открыть в новом окне'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_by', 'asc');
    }
}
