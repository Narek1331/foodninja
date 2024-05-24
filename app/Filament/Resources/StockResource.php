<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StockResource\Pages;
use App\Filament\Resources\StockResource\RelationManagers;
use App\Models\Stock;
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
use Filament\Forms\Components\RichEditor;

class StockResource extends Resource
{
    protected static ?string $model = Stock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Акции';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $pluralLabel = 'Акции';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required(),
                Select::make('display_location_id')
                    ->label('Канал отображения')
                    ->required()
                    ->options(DisplayLocation::all()
                    ->pluck('name', 'id')),
                RichEditor::make('text')
                    ->label('Текст')
                    ->columnSpan('full'),
                TextInput::make('promo_code')
                    ->label('Промокод')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->options([
                        '1' => 'Опубликовано',
                        '0' => 'Черновик',
                    ]),
                Forms\Components\FileUpload::make('img_path')
                    ->directory('images')
                    ->label('Изображение')
                    ->maxSize(1024)
                    ->acceptedFileTypes(['image/*'])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable(),
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
            ->defaultSort('created_at', 'asc');

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
            'index' => Pages\ListStocks::route('/'),
            'create' => Pages\CreateStock::route('/create'),
            'edit' => Pages\EditStock::route('/{record}/edit'),
        ];
    }
}
