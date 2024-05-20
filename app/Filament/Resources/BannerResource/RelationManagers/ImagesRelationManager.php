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

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';
    protected static ?string $recordTitleAttribute = 'img_path';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('recommended_sizes')
                            ->label('Recommended image sizes:')
                            ->content('PC: 1240x360 px, Mobile: 910x480 px')
                            ->columnSpan('full'),
                        Forms\Components\FileUpload::make('img_path')
                            ->directory('images')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*'])
                            ->requiredWithout('img_full_path'),
                        TextInput::make('img_full_path')
                        ->type('url')
                        ->label('Set image URL')
                        ->requiredWithout('img_path'),
                        Forms\Components\Checkbox::make('new_window')
                            ->label('Open in new window'),
                        TextInput::make('autoscroll_seconds')
                            ->type('number')
                            ->label('Autoscroll Seconds')
                            ->required(),
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
                    ->label('Image')
                    ->size(150),
                Tables\Columns\BooleanColumn::make('new_window')
                    ->label('Open in New Window'),
                Tables\Columns\TextColumn::make('order_by')
                    ->label('Order')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Date')
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Add Image'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Edit'),
                Tables\Actions\DeleteAction::make()->label('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->label('Delete Selected'),
                ]),
            ])
            ->defaultSort('order_by', 'asc');

    }
}
