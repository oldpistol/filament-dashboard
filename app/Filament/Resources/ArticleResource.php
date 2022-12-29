<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('attachment')->required(),
                Forms\Components\Select::make('sentiment')->required()
                    ->options([
                        'neutral' => 'Neutral',
                        'positive' => 'Positive',
                        'negative' => 'Negative'
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no')->rowIndex(),
                Tables\Columns\TextColumn::make('title')->url(fn($record) => url('storage/' . $record->attachment), true),
                Tables\Columns\BadgeColumn::make('sentiment')
                    ->colors([
                        'secondary' => 'neutral',
                        'success' => 'positive',
                        'danger' => 'negative',
                    ])
                    ->enum([
                        'neutral' => 'Neutral',
                        'positive' => 'Positive',
                        'negative' => 'Negative'
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            // 'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
    
}
