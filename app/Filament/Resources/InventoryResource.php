<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Models\Inventory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    
    // protected static ?string $navigationLabel = 'Inventário';//property que muda o nome da navigation
    protected static ?string $modelLabel = 'Inventário';
    protected static ?string $pluralModel = 'Inventários';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nome')
              ,
              Forms\Components\TextInput::make('description')
              ->label('Descrição')
            ,
            Forms\Components\FileUpload::make('image')
                ->image()
                ->label('Imagem')
            ,
            Forms\Components\TextInput::make('quantity')
              ->label('Quantidade')
            ,
            Forms\Components\TextInput::make('category_id')
              ->label('Categoria')
            ,
              
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Nome')
                ->searchable(),
                Tables\Columns\TextColumn::make('description')
                ->label('Descrição')
                ->searchable(),
                Tables\Columns\TextColumn::make('image')->label('Imagem'),
                Tables\Columns\TextColumn::make('quantity')
                ->label('Quantidade')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('category_id')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }    
}
