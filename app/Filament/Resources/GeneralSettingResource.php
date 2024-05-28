<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralSettingResource\Pages;
use App\Filament\Resources\GeneralSettingResource\RelationManagers;
use App\Models\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GeneralSettingResource extends Resource
{
    protected static ?string $model = GeneralSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Общие';

    protected static ?string $navigationGroup = 'Настройки';

    protected static ?string $pluralLabel = 'Общие';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Заголовок сайта (Title)')
                ->maxLength(255)
                ->columnSpan('full'),

            Forms\Components\TextInput::make('h1_title')
                ->label('Заголовок H1')
                ->maxLength(255)
                ->columnSpan('full'),

            Forms\Components\Textarea::make('description')
                ->label('Описание сайта (Description)')
                ->maxLength(65535)
                ->rows(5)
                ->columnSpan('full'),

            Forms\Components\Select::make('timezone')
                ->label('Часовой пояс')
                ->options(getTimezones())
                ->searchable()
                ->placeholder('Выберите часовой пояс')
                ->columnSpan('full'),

            Forms\Components\Textarea::make('head_code')
                ->label('Код в HEAD')
                ->maxLength(65535)
                ->rows(5)
                ->columnSpan('full'),

            Forms\Components\TextInput::make('how_many_pieces_for_free_condiments')
                ->label('На сколько штук (8 шт. = 1 ролл) дается бесплатная порция соевого соуса, васаби и имбиря')
                ->maxLength(255)
                ->columnSpan('full')
                ->helperText('Если не нужно, то оставьте поле пустым.'),

            Forms\Components\Toggle::make('redirect_nonexistent_pages_to_home')
                ->label('Редирект на главную с несуществующих страниц')
                ->columnSpan('full')
                ->helperText('Автоматически перенаправлять пользователя на главную страницу при обращении к несуществующей странице.'),

            Forms\Components\Toggle::make('site_search')
                ->label('Поиск на сайте')
                ->columnSpan('full')
                ->helperText('Включить или отключить поисковую функцию на сайте.')
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGeneralSettings::route('/'),
            'create' => Pages\CreateGeneralSetting::route('/create'),
            'edit' => Pages\EditGeneralSetting::route('/{record}/edit'),
        ];
    }
}
