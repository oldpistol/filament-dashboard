<?php

namespace App\Filament\Widgets;

use Filament\Widgets\DoughnutChartWidget;

class ArticleSentimentChart extends DoughnutChartWidget
{
    protected static ?string $heading = 'Article Sentiment';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Sentiment',
                    'data' => [1,2,3],
                    'backgroundColor' => [
                        'rgb(240,241,242)',
                        'rgb(232,249,239)',
                        'rgb(254,235,239)'
                    ],
                    'hoverOffset' => 4
                ],
            ],
            'labels' => ['Neutral', 'Positive', 'Negative']
        ];
    }
}
