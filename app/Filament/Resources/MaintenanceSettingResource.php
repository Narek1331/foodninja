<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaintenanceSettingResource\Pages;
use App\Filament\Resources\MaintenanceSettingResource\RelationManagers;
use App\Models\Maintenance\MaintenanceSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use App\Models\Maintenance\MaintenanceSettingMode;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\Section;

class MaintenanceSettingResource extends Resource
{
    protected static ?string $model = MaintenanceSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-no-symbol';

    protected static ?string $navigationLabel = 'Отключить платформу';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $pluralLabel = 'Отключить платформу';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Card::make()
                ->description('Вы можете временно отключить платформу (сайт и приложения). Для этого укажите период отключения и текст уведомления для пользователей.')
                ->schema([
                    Select::make('maintenance_setting_mode_id')
                        ->default(MaintenanceSettingMode::query()->pluck('id')->first())
                        ->label('Режим')
                        ->required()
                        ->options(MaintenanceSettingMode::query()->pluck('name', 'id')->toArray())
                        ->reactive()
                        ->afterStateUpdated(function (callable $set, $state) {
                            $mode = MaintenanceSettingMode::find($state);
                            if ($mode && $mode->name === 'Часы высокой нагрузки') {
                                $set('turned_off_date', 'Когда будет выключен режим высокой нагрузки');
                                $set('turned_on_date', 'Когда будет включен режим высокой нагрузки');
                            } else {
                                $set('turned_off_date', 'Когда сайт будет отключен');
                                $set('turned_on_date', 'Когда сайт будет включен');
                            }
                        }),

                    DateTimePicker::make('turned_off_date')
                        ->label(fn (callable $get) => $get('turned_off_date') ?? 'Когда сайт будет отключен')
                        ->columnSpan('full'),

                    DateTimePicker::make('turned_on_date')
                        ->label(fn (callable $get) => $get('turned_on_date') ?? 'Когда сайт будет включен')
                        ->columnSpan('full'),

                    TextInput::make('title')
                        ->label('Заголовок')
                        ->columnSpan('full'),

                    RichEditor::make('text')
                        ->label('Текст')
                        ->columnSpan('full'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Define columns here
            ])
            ->filters([
                // Define filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            // Define relations here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMaintenanceSettings::route('/'),
            'create' => Pages\CreateMaintenanceSetting::route('/create'),
            'edit' => Pages\EditMaintenanceSetting::route('/{record}/edit'),
        ];
    }
}
