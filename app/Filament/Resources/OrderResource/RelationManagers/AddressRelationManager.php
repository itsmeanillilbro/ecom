<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;


use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AddressRelationManager extends RelationManager
{
    protected static string $relationship = 'address';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('city')
                    ->required()
                    ->maxLength(255),


                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->maxLength(255),

                TextInput::make('state')
                    ->required()
                    ->maxLength(255),

                TextInput::make('zip_code')
                    ->required()
                    ->maxLength(25),

                TextInput::make('street_address')
                    ->required()
                    ->maxLength(255)

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('phone')
            ->columns([

                TextColumn::make('fullname')
                    ->label('Full Name'),

                TextColumn::make('phone'),

                TextColumn::make('city'),

                TextColumn::make('state'),

                TextColumn::make('zip_code'),

                TextColumn::make('street_address'),

                Tables\Columns\TextColumn::make('phone'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);

    }


}
