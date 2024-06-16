<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStat extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Orders', Order::query()->where('status','new')->count()),
            Stat::make('Processing Orders', Order::query()->where('status', 'processing')->count()),
            Stat::make('Shipped Orders', Order::query()->where('status','shipped')->count())
        ];
    }
}
