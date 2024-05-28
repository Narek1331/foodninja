<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuSettingResource\Pages;
use App\Filament\Resources\MenuSettingResource\RelationManagers;
use App\Models\MenuSetting\MenuSetting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Redirect;

class MenuSettingResource extends Resource
{
    protected static ?string $model = MenuSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $navigationLabel = 'Меню';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $pluralLabel = 'Меню';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
        ->schema([
            Select::make('menu_setting_id')
                ->options(MenuSetting::all()->pluck('name', 'id'))
                ->label('Выберите меню для изменения')
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state) {
                    if (!empty($state)) {
                        Redirect::to("/foodninja/menu-settings/$state/edit");
                    }
                }),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Меню')
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuSettings::route('/'),
            'edit' => Pages\EditMenuSetting::route('/{record}/edit'),
        ];
    }

}
