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

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('recommended_sizes')
                            ->label('Recommended image sizes:')
                            ->content('450x800')
                            ->columnSpan('full'),
                        Forms\Components\FileUpload::make('img_path')
                            ->directory('images')
                            ->maxSize(1024)
                            ->acceptedFileTypes(['image/*'])
                            ->requiredWithout('youtube_video_url'),
                        TextInput::make('youtube_video_url')
                            ->type('url')
                            ->label('YouTube Video URL')
                            ->requiredWithout('img_path'),
                        Forms\Components\Checkbox::make('show_description')
                            ->label('Add description')
                            ->reactive(),
                        TextInput::make('description')
                            ->type('text')
                            ->label('Description')
                            ->visible(fn ($get) => $get('show_description')),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                '1' => 'Опубликовано',
                                '0' => 'Черновик',
                            ])
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
                Tables\Columns\TextColumn::make('youtube_video_url')
                    ->label('YouTube Video URL'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->sortable(),
                CheckboxColumn::make('status')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Опубликовано',
                        '0' => 'Черновик',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        if($data && isset($data['value'])){
                            return $query->where('status', $data['value']);
                        }
                        return $query;
                    }),
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
                    Tables\Actions\ForceDeleteBulkAction::make()->label('Delete Forever'),
                ]),
            ])
            ->defaultSort('order_by', 'asc');
    }
}
