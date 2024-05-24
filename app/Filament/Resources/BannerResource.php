<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Filament\Resources\BannerResource\RelationManagers;
use App\Models\Banner;
use App\Models\DisplayLocation;
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

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Баннеры';

    protected static ?string $navigationGroup = 'Контент';

    protected static ?string $pluralLabel = 'Баннеры';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('display_location_id')
                ->options(DisplayLocation::all()->pluck('name', 'id'))
                ->label('Канал отображения')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('displayLocation.name')
                ->label('Канал отображения')
                ->searchable(),
                TextColumn::make('created_at')
                ->label('Дата')
                ->searchable()
            ])
            ->filters([
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
                Tables\Actions\EditAction::make()->label('Редактировать'),
                Tables\Actions\DeleteAction::make()->label('Удалить'),
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
            RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
