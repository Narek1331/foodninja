<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoryResource\Pages;
use App\Filament\Resources\StoryResource\RelationManagers;
use App\Models\Story;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Carbon\Carbon;
use App\Models\DisplayLocation;
use Filament\Tables\Filters\SelectFilter;

class StoryResource extends Resource
{
    protected static ?string $model = Story::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';

    protected static ?string $navigationLabel = 'Сторис';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $pluralLabel = 'Сторис';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Название сторис')
                ->required(),
            Select::make('display_location_id')
                ->label('Канал отображения')
                ->required()
                ->options(DisplayLocation::all()
                ->pluck('name', 'id')),
            Forms\Components\Select::make('status')
                            ->label('Статус')
                            ->options([
                                '1' => 'Опубликовано',
                                '0' => 'Черновик',
                            ])
                            ->required(),
            Forms\Components\FileUpload::make('img_path')
            ->directory(function () {
                $merchantId = auth()->user()->merchantId();
                return "{$merchantId}/story";
            })
            ->label('Основное изображение')
            ->maxSize(1024)
            ->acceptedFileTypes(['image/*'])

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_by')
            ->columns([
                TextColumn::make('displayLocation.name')
                ->label('Канал отображения')
                ->searchable(),
                Tables\Columns\ImageColumn::make('img_path')
                    ->label('Основное изображение')
                    ->size(150),
                TextColumn::make('created_at')
                ->label('Дата')
                ->searchable()
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Статус')
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
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('От'),
                        Forms\Components\DatePicker::make('created_until')->label('До'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date) => $query->whereDate('created_at', '>=', Carbon::parse($date))
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date) => $query->whereDate('created_at', '<=', Carbon::parse($date))
                            );
                    }),
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

    public static function getRelations(): array
    {
        return [
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStories::route('/'),
            'create' => Pages\CreateStory::route('/create'),
            'edit' => Pages\EditStory::route('/{record}/edit'),
        ];
    }
}
