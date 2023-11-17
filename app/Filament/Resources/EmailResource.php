<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmailResource\Pages;
use App\Filament\Resources\EmailResource\RelationManagers;
use App\Models\Email;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmailResource extends Resource
{
    protected static ?string $model = Email::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Email Templates';

    protected static ?string $navigationGroup = 'Super Admin';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subject')
                    ->required()
                    ->maxLength(255),
                Textarea::make('content')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                TextInput::make('from_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('from_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('cc_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('from_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cc_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListEmails::route('/'),
            'create' => Pages\CreateEmail::route('/create'),
            'view' => Pages\ViewEmail::route('/{record}'),
            'edit' => Pages\EditEmail::route('/{record}/edit'),
        ];
    }    
}
