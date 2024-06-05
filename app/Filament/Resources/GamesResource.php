<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GamesResource\Pages;
use App\Models\Games;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;

class GamesResource extends Resource
{
    protected static ?string $model = Games::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationGroup = 'Games';
    protected static ?int $navigationSort = 1;

    protected static ?string $label = 'View Game';
    protected static ?string $pluralLabel = 'View Games';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->required()->numeric(),
                FileUpload::make('image')
                    ->label('Image')
                    ->directory('ads')
                    ->visibility('public')
                    ->image()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Grid::make()->columns(1)->schema([
                    TextColumn::make('name')
                        ->label('Game Name')
                        ->sortable()
                        ->searchable()
                        ->extraAttributes(['class' => 'text-blue-500']),
                    TextColumn::make('price')
                        ->label('Price')
                        ->sortable()
                        ->searchable()
                        ->formatStateUsing(fn ($state) => '$' . number_format($state, 2)),
                    ImageColumn::make('image')->label('Image')->width(200)->height(150),
                ])
            ])->contentGrid([
                'md' => 2,
                'xl' => 4,
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListGames::route('/'),
            // 'create' => Pages\CreateGames::route('/create'),
            // 'edit' => Pages\EditGames::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($model): bool
    {
        return false;
    }

    public static function canDelete($model): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function canView($model): bool
    {
        return true;
    }



    public static function canViewAny(): bool
    {
        return !Auth()->user()->role;
    }
}


/*


                // Grid::make()->columns(1)->schema([
                //     ViewColumn::make("image")->view("components.GameCard")
                // ])
*/
