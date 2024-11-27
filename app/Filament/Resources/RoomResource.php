<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Filament\Resources\RoomResource\RelationManagers;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('Image House')
                        ->schema([
                            Forms\Components\FileUpload::make('image')
                            ->hiddenLabel()
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ])
                        ])
                    ]),
                Forms\Components\Group::make()
                 ->schema([
                    Forms\Components\Section::make('Details House')
                    ->schema([
                        Forms\Components\textarea::make('address')
                        ->placeholder('enter address')
                        ->required()
                        ->autosize()
                        ->maxLength(255),
                    Forms\Components\Select::make('type')
                        ->placeholder('select types of house')
                        ->options([
                            'terrace' => 'Terrace',
                            'link' => 'Link',
                            'super link' => 'Super Link',
                        ])
                        ->required(),
                    Forms\Components\Select::make('total_room')
                        ->placeholder('select total of room')
                        ->options([
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                        ])
                        ->required()
                        ->columnspanfull(),
                    ])
                 ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_room')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'view' => Pages\ViewRoom::route('/{record}'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
}
