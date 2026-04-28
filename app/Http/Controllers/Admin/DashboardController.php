<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function ecommerce(Request $request)
    {
        return $this->renderAnalyticsDashboard($request);
    }

    public function analytics(Request $request)
    {
        return $this->renderAnalyticsDashboard($request);
    }

    public function crm()
    {
        return view('admin.dashboard.crm');
    }

    public function finance()
    {
        return view('admin.dashboard.finance');
    }

    public function projects()
    {
        return view('admin.dashboard.projects');
    }

    private function renderAnalyticsDashboard(Request $request)
    {
        $supportedRanges = ['weekly', 'monthly', 'weekend', 'yearly'];
        $activeRange = strtolower((string) $request->query('range', 'monthly'));
        if (!in_array($activeRange, $supportedRanges, true)) {
            $activeRange = 'monthly';
        }

        $rangeAnalytics = [];
        foreach ($supportedRanges as $range) {
            $rangeAnalytics[$range] = $this->buildRangeAnalytics($range);
        }

        $topProducts = DB::table('order_items')
            ->selectRaw('product_name, SUM(quantity) as total_quantity, SUM(line_total) as total_amount')
            ->groupBy('product_name')
            ->orderByDesc('total_quantity')
            ->limit(8)
            ->get();

        $recentOrders = Order::query()
            ->latest()
            ->limit(8)
            ->get(['id', 'name', 'city', 'status', 'payment_method', 'total', 'created_at']);

        $qualityStats = Review::query()
            ->where('status', true)
            ->selectRaw('COUNT(*) as total_reviews')
            ->selectRaw('AVG(stars) as avg_stars')
            ->selectRaw('SUM(CASE WHEN stars >= 4 THEN 1 ELSE 0 END) as positive_reviews')
            ->first();

        $qualityCheck = [
            'total_reviews' => (int) ($qualityStats->total_reviews ?? 0),
            'avg_stars' => round((float) ($qualityStats->avg_stars ?? 0), 1),
            'positive_rate' => $this->percent(
                (float) ($qualityStats->positive_reviews ?? 0),
                (float) ($qualityStats->total_reviews ?? 0)
            ),
            'active_products' => Product::active()->count(),
            'low_stock_products' => Product::active()->where('stock', '<=', 5)->count(),
        ];

        return view('admin.dashboard.analytics', [
            'activeRange' => $activeRange,
            'rangeAnalytics' => $rangeAnalytics,
            'topProducts' => $topProducts,
            'recentOrders' => $recentOrders,
            'qualityCheck' => $qualityCheck,
        ]);
    }

    private function buildRangeAnalytics(string $range): array
    {
        [$startDate, $endDate, $weekendOnly] = $this->resolveDateWindow($range);
        $previousWindow = $this->previousDateWindow($startDate, $endDate);

        $orders = Order::query()
            ->withCount('items')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        if ($weekendOnly) {
            $orders = $orders->filter(fn ($order) => Carbon::parse($order->created_at)->isWeekend())->values();
        }

        $trend = $this->buildTrendSeries($range, $orders, $startDate, $endDate, $weekendOnly);

        $statusCounts = ['pending' => 0, 'processing' => 0, 'shipped' => 0, 'delivered' => 0, 'cancelled' => 0];
        $cityCounts = [];
        $paymentCounts = [];

        $totalOrders = $orders->count();
        $orderTotal = (float) $orders->sum('total');
        $subtotal = (float) $orders->sum('subtotal');
        $deliveryTotal = (float) $orders->sum('delivery_charge');
        $discountTotal = (float) $orders->sum('discount');
        $cartOrders = (int) $orders->where('items_count', '>', 1)->count();
        $totalItems = (float) $orders->sum('items_count');

        foreach ($orders as $order) {
            $status = strtolower((string) $order->status);
            if (array_key_exists($status, $statusCounts)) {
                $statusCounts[$status]++;
            }

            $city = (string) $order->city;
            $cityCounts[$city] = ($cityCounts[$city] ?? 0) + 1;

            $payment = strtoupper((string) $order->payment_method);
            $paymentCounts[$payment] = ($paymentCounts[$payment] ?? 0) + 1;
        }

        $orderItems = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->select('order_items.product_name', 'order_items.quantity', 'order_items.line_total', 'orders.created_at as ordered_at')
            ->get();

        if ($weekendOnly) {
            $orderItems = $orderItems->filter(fn ($item) => Carbon::parse($item->ordered_at)->isWeekend())->values();
        }

        $productAgg = [];
        foreach ($orderItems as $item) {
            $name = (string) $item->product_name;
            if (!isset($productAgg[$name])) {
                $productAgg[$name] = [
                    'name' => $name,
                    'quantity' => 0,
                    'amount' => 0,
                ];
            }
            $productAgg[$name]['quantity'] += (int) $item->quantity;
            $productAgg[$name]['amount'] += (float) $item->line_total;
        }

        $productParticipation = collect($productAgg)
            ->sortByDesc('quantity')
            ->take(8)
            ->values()
            ->all();

        $currentWindow = [
            'orders' => $totalOrders,
            'revenue' => $orderTotal,
        ];
        $previousTotals = $this->windowTotals($previousWindow['start'], $previousWindow['end'], $weekendOnly);

        $growth = [
            'orders' => $this->growthPercent($currentWindow['orders'], $previousTotals['orders']),
            'revenue' => $this->growthPercent($currentWindow['revenue'], $previousTotals['revenue']),
        ];

        return [
            'range' => $range,
            'window' => [
                'start' => $startDate->toDateString(),
                'end' => $endDate->toDateString(),
            ],
            'summary' => [
                'orders' => $totalOrders,
                'order_total' => round($orderTotal, 2),
                'subtotal' => round($subtotal, 2),
                'delivery_total' => round($deliveryTotal, 2),
                'discount_total' => round($discountTotal, 2),
                'cart_orders' => $cartOrders,
                'aov' => round($totalOrders > 0 ? $orderTotal / $totalOrders : 0, 2),
                'avg_items_per_order' => round($totalOrders > 0 ? $totalItems / $totalOrders : 0, 2),
                'delivered_rate' => $this->percent($statusCounts['delivered'], $totalOrders),
                'cancelled_rate' => $this->percent($statusCounts['cancelled'], $totalOrders),
                'growth' => $growth,
            ],
            'trend' => $trend,
            'status_participation' => [
                'labels' => array_map('ucfirst', array_keys($statusCounts)),
                'series' => array_values($statusCounts),
            ],
            'delivery_participation' => $this->formatKeyValueParticipation($cityCounts, 6),
            'payment_participation' => $this->formatKeyValueParticipation($paymentCounts, 6),
            'product_participation' => $productParticipation,
        ];
    }

    private function resolveDateWindow(string $range): array
    {
        $now = now();

        return match ($range) {
            'weekly' => [$now->copy()->startOfWeek(), $now->copy()->endOfWeek(), false],
            'weekend' => [$now->copy()->subWeeks(8)->startOfWeek(), $now->copy()->endOfWeek(), true],
            'yearly' => [$now->copy()->startOfYear(), $now->copy()->endOfYear(), false],
            default => [$now->copy()->startOfMonth(), $now->copy()->endOfMonth(), false],
        };
    }

    private function previousDateWindow(Carbon $startDate, Carbon $endDate): array
    {
        $seconds = $startDate->diffInSeconds($endDate) + 1;
        $prevEnd = $startDate->copy()->subSecond();
        $prevStart = $prevEnd->copy()->subSeconds($seconds - 1);

        return ['start' => $prevStart, 'end' => $prevEnd];
    }

    private function windowTotals(Carbon $startDate, Carbon $endDate, bool $weekendOnly): array
    {
        $orders = Order::query()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get(['id', 'total', 'created_at']);

        if ($weekendOnly) {
            $orders = $orders->filter(fn ($order) => Carbon::parse($order->created_at)->isWeekend())->values();
        }

        return [
            'orders' => (float) $orders->count(),
            'revenue' => (float) $orders->sum('total'),
        ];
    }

    private function buildTrendSeries(
        string $range,
        $orders,
        Carbon $startDate,
        Carbon $endDate,
        bool $weekendOnly
    ): array {
        $buckets = [];

        if ($range === 'yearly') {
            for ($month = 1; $month <= 12; $month++) {
                $key = $startDate->copy()->month($month)->startOfMonth()->format('Y-m');
                $buckets[$key] = [
                    'label' => $startDate->copy()->month($month)->startOfMonth()->format('M'),
                    'revenue' => 0,
                    'orders' => 0,
                    'delivery' => 0,
                ];
            }
        } else {
            $cursor = $startDate->copy()->startOfDay();
            $limit = $endDate->copy()->endOfDay();

            while ($cursor->lte($limit)) {
                if (!$weekendOnly || $cursor->isWeekend()) {
                    $key = $cursor->format('Y-m-d');
                    $label = $range === 'weekly'
                        ? $cursor->format('D')
                        : $cursor->format('d M');

                    $buckets[$key] = [
                        'label' => $label,
                        'revenue' => 0,
                        'orders' => 0,
                        'delivery' => 0,
                    ];
                }
                $cursor->addDay();
            }
        }

        foreach ($orders as $order) {
            $orderedAt = Carbon::parse($order->created_at);
            $key = $range === 'yearly' ? $orderedAt->format('Y-m') : $orderedAt->format('Y-m-d');

            if (!isset($buckets[$key])) {
                continue;
            }

            $buckets[$key]['revenue'] += (float) $order->total;
            $buckets[$key]['orders'] += 1;
            $buckets[$key]['delivery'] += (float) $order->delivery_charge;
        }

        return [
            'labels' => array_column($buckets, 'label'),
            'revenue' => array_values(array_map(fn ($bucket) => round($bucket['revenue'], 2), $buckets)),
            'orders' => array_column($buckets, 'orders'),
            'delivery' => array_values(array_map(fn ($bucket) => round($bucket['delivery'], 2), $buckets)),
        ];
    }

    private function formatKeyValueParticipation(array $items, int $limit = 6): array
    {
        arsort($items);
        $sliced = array_slice($items, 0, $limit, true);

        return [
            'labels' => array_keys($sliced),
            'series' => array_values($sliced),
        ];
    }

    private function percent(float $value, float $total): float
    {
        if ($total <= 0) {
            return 0;
        }

        return round(($value / $total) * 100, 2);
    }

    private function growthPercent(float $current, float $previous): float
    {
        if ($previous <= 0) {
            return $current > 0 ? 100 : 0;
        }

        return round((($current - $previous) / $previous) * 100, 2);
    }
}
