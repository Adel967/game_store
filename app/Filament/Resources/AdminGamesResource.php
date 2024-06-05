<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminGamesResource\Pages;
use App\Models\Games;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdminGamesResource extends Resource
{
    protected static ?string $model = Games::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $navigationGroup = 'games';

    protected static ?string $label = 'Manage Game';
    protected static ?string $pluralLabel = 'Manage Games';

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
                    ->visibility('public') // Ensure visibility is set to public
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('price')->sortable()->searchable(),
                ImageColumn::make('image')->label('Image'),
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
            'index' => Pages\ListAdminGames::route('/'),
            'create' => Pages\CreateAdminGames::route('/create'),
            'edit' => Pages\EditAdminGames::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        return Auth()->user()->role;
    }
}
