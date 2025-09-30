<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class ProductsChart extends ChartWidget
{
    protected   ?string $heading = 'Products Per Month';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $productsPerMonth = $this->getProductsPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Products Created',
                    'data' => $productsPerMonth['data'],
                ],
            ],
            'labels' => $productsPerMonth['labels'],
        ];
    }

    private function getProductsPerMonth(): array
    {
        $now = Carbon::now();
        $data = [];
        $labels = [];

         foreach (range(1, 12) as $month) {
            $count = Product::whereMonth('created_at', $month)
                ->whereYear('created_at', $now->year)
                ->count();
            $data[] = $count;
            $labels[] = Carbon::createFromDate($now->year, $month, 1)->format('M');
        }

        return [
            'data' => $data,
            'labels' => $labels,
        ];
    }
}
