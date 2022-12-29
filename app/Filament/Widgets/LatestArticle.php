<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestArticle extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected function getTableQuery(): Builder
    {
        return Article::query()->latest();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('id'),
            Tables\Columns\TextColumn::make('title')->url(fn($record) => url('storage/' . $record->attachment)),
            Tables\Columns\BadgeColumn::make('sentiment')
                ->enum([
                    'neutral' => 'Neutral',
                    'positive' => 'Positive',
                    'negative' => 'Negative'
                ])
                ->colors([
                    'secondary' => 'neutral',
                    'success' => 'positive',
                    'danger' => 'negative'
                ]),
            Tables\Columns\TextColumn::make('created_at')->dateTime()
        ];
    }
}
