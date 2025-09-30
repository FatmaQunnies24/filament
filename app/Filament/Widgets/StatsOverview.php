<?php

namespace App\Filament\Widgets;

use in;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Customers', Customer::count())
                ->description('Increase in customers')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

          Stat::make('Total Products', Product::count())
            ->description('Total products in app')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger')
            ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

        Stat::make('Pending Orders', Order::where('status', 'Pending')->count())
            ->description('Total pending orders in app')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->color('danger')
            ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
          ];  }
}
