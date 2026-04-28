@extends('admin.layouts.app')

@section('title', 'Analytics Dashboard')

@php
    $rangeLabels = [
        'weekly' => 'Weekly',
        'monthly' => 'Monthly',
        'weekend' => 'Weekend',
        'yearly' => 'Yearly',
    ];
    $activeData = $rangeAnalytics[$activeRange] ?? $rangeAnalytics['monthly'];
@endphp

@push('styles')
<style>
    .analytics-kpi-value {
        font-size: 1.55rem;
        font-weight: 700;
        line-height: 1.2;
    }
    .analytics-kpi-sub {
        font-size: 0.82rem;
    }
    .analytics-chart-lg {
        min-height: 360px;
    }
    .analytics-chart-md {
        min-height: 300px;
    }
    .analytics-table-wrap {
        max-height: 360px;
        overflow-y: auto;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex flex-wrap align-items-center gap-2 mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Decision Analytics Dashboard</h4>
            <p class="text-muted mb-0 fs-13">
                Sales, quality, product participation, order flow, and delivery insights in one page.
            </p>
        </div>
        <div class="btn-group" role="group" aria-label="Range Filter">
            @foreach($rangeLabels as $key => $label)
                <button
                    type="button"
                    class="btn {{ $activeRange === $key ? 'btn-primary' : 'btn-outline-primary' }} range-filter-btn"
                    data-range="{{ $key }}"
                >
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Order Summary</p>
                    <div class="analytics-kpi-value" id="kpi-orders">{{ number_format($activeData['summary']['orders']) }}</div>
                    <div class="analytics-kpi-sub text-muted">Growth <span id="kpi-orders-growth">{{ $activeData['summary']['growth']['orders'] }}</span>% vs previous period</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Sales (Total)</p>
                    <div class="analytics-kpi-value" id="kpi-total">BDT {{ number_format($activeData['summary']['order_total'], 2) }}</div>
                    <div class="analytics-kpi-sub text-muted">Revenue growth <span id="kpi-revenue-growth">{{ $activeData['summary']['growth']['revenue'] }}</span>%</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Cart Subtotal</p>
                    <div class="analytics-kpi-value" id="kpi-subtotal">BDT {{ number_format($activeData['summary']['subtotal'], 2) }}</div>
                    <div class="analytics-kpi-sub text-muted">AOV: <span id="kpi-aov">{{ number_format($activeData['summary']['aov'], 2) }}</span></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Cart Delivery</p>
                    <div class="analytics-kpi-value" id="kpi-delivery">BDT {{ number_format($activeData['summary']['delivery_total'], 2) }}</div>
                    <div class="analytics-kpi-sub text-muted">Cart orders: <span id="kpi-cart-orders">{{ number_format($activeData['summary']['cart_orders']) }}</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-xxl-8">
            <div class="card h-100">
                <div class="card-header justify-content-between">
                    <h4 class="card-title mb-0">Product-Based Sales & Delivery Trend</h4>
                    <span class="badge badge-soft-primary text-uppercase" id="active-range-label">{{ $rangeLabels[$activeRange] }}</span>
                </div>
                <div class="card-body">
                    <div id="orders-trend-chart" class="analytics-chart-lg"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xxl-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h4 class="card-title mb-0">Order Participation</h4>
                </div>
                <div class="card-body">
                    <div id="status-chart" class="analytics-chart-md"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Delivery Participation</h4>
                </div>
                <div class="card-body">
                    <div id="delivery-chart" class="analytics-chart-md"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-xxl-8">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Product Participation (By Ordered Quantity)</h4>
                </div>
                <div class="card-body">
                    <div id="product-chart" class="analytics-chart-md"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xxl-4">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Quality Check & Advanced Metrics</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Delivered Participation</span>
                            <span id="metric-delivered-rate">{{ $activeData['summary']['delivered_rate'] }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" id="metric-delivered-progress" role="progressbar" style="width: {{ $activeData['summary']['delivered_rate'] }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Cancelled Participation</span>
                            <span id="metric-cancelled-rate">{{ $activeData['summary']['cancelled_rate'] }}%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" id="metric-cancelled-progress" role="progressbar" style="width: {{ $activeData['summary']['cancelled_rate'] }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Average Items / Order</span>
                            <span id="metric-items-per-order">{{ $activeData['summary']['avg_items_per_order'] }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Quality Score (Avg Stars)</span>
                        <span>{{ number_format($qualityCheck['avg_stars'], 1) }}/5</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Positive Review Rate</span>
                        <span>{{ $qualityCheck['positive_rate'] }}%</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Active Products</span>
                        <span>{{ number_format($qualityCheck['active_products']) }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Low Stock (<=5)</span>
                        <span>{{ number_format($qualityCheck['low_stock_products']) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-12 col-xl-6">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Top Products (All Time)</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive analytics-table-wrap">
                        <table class="table table-custom table-hover mb-0">
                            <thead class="bg-light bg-opacity-25">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-end">Quantity</th>
                                    <th class="text-end">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topProducts as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td class="text-end">{{ number_format($product->total_quantity) }}</td>
                                        <td class="text-end">BDT {{ number_format($product->total_amount, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-3 text-muted">No product sales data yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="card-title mb-0">Recent Orders</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive analytics-table-wrap">
                        <table class="table table-custom table-hover mb-0">
                            <thead class="bg-light bg-opacity-25">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>City</th>
                                    <th class="text-end">Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td class="text-capitalize">{{ $order->city }}</td>
                                        <td class="text-end">BDT {{ number_format($order->total, 2) }}</td>
                                        <td>
                                            <span class="badge badge-soft-{{ statusColor($order->status) }} text-capitalize">{{ $order->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3 text-muted">No orders found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rangeLabels = {
            weekly: 'Weekly',
            monthly: 'Monthly',
            weekend: 'Weekend',
            yearly: 'Yearly',
        };
        const dataset = @json($rangeAnalytics);
        let activeRange = @json($activeRange);

        const el = {
            orders: document.getElementById('kpi-orders'),
            ordersGrowth: document.getElementById('kpi-orders-growth'),
            total: document.getElementById('kpi-total'),
            revenueGrowth: document.getElementById('kpi-revenue-growth'),
            subtotal: document.getElementById('kpi-subtotal'),
            aov: document.getElementById('kpi-aov'),
            delivery: document.getElementById('kpi-delivery'),
            cartOrders: document.getElementById('kpi-cart-orders'),
            deliveredRate: document.getElementById('metric-delivered-rate'),
            cancelledRate: document.getElementById('metric-cancelled-rate'),
            deliveredProgress: document.getElementById('metric-delivered-progress'),
            cancelledProgress: document.getElementById('metric-cancelled-progress'),
            itemsPerOrder: document.getElementById('metric-items-per-order'),
            activeRangeLabel: document.getElementById('active-range-label'),
        };

        const formatInt = (value) => new Intl.NumberFormat().format(value || 0);
        const formatMoney = (value) => `BDT ${new Intl.NumberFormat(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(value || 0)}`;
        const seriesOrZero = (arr) => (arr && arr.length ? arr : [0]);
        const labelsOrNA = (arr) => (arr && arr.length ? arr : ['N/A']);

        const chartTheme = {
            primary: '#4f46e5',
            success: '#16a34a',
            warning: '#d97706',
            danger: '#dc2626',
            slate: '#475569',
            info: '#0284c7',
        };

        const trendChart = new ApexCharts(document.querySelector('#orders-trend-chart'), {
            chart: { type: 'line', height: 360, toolbar: { show: false } },
            stroke: { width: [3, 3, 2], curve: 'smooth', dashArray: [0, 0, 6] },
            series: [],
            colors: [chartTheme.primary, chartTheme.success, chartTheme.warning],
            xaxis: { categories: [] },
            yaxis: [
                { title: { text: 'Amount (BDT)' } },
                { opposite: true, title: { text: 'Orders' } }
            ],
            dataLabels: { enabled: false },
            legend: { position: 'top' },
            tooltip: { shared: true, intersect: false }
        });

        const statusChart = new ApexCharts(document.querySelector('#status-chart'), {
            chart: { type: 'donut', height: 300 },
            series: [],
            labels: [],
            colors: [chartTheme.warning, chartTheme.info, chartTheme.primary, chartTheme.success, chartTheme.danger],
            legend: { position: 'bottom' },
            dataLabels: { enabled: true },
        });

        const deliveryChart = new ApexCharts(document.querySelector('#delivery-chart'), {
            chart: { type: 'bar', height: 300, toolbar: { show: false } },
            plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
            series: [{ name: 'Orders', data: [] }],
            xaxis: { categories: [] },
            colors: [chartTheme.slate],
            dataLabels: { enabled: false },
        });

        const productChart = new ApexCharts(document.querySelector('#product-chart'), {
            chart: { type: 'bar', height: 300, toolbar: { show: false } },
            plotOptions: { bar: { horizontal: true, borderRadius: 4 } },
            series: [{ name: 'Quantity', data: [] }],
            xaxis: { categories: [] },
            colors: [chartTheme.primary],
            dataLabels: { enabled: false },
        });

        trendChart.render();
        statusChart.render();
        deliveryChart.render();
        productChart.render();

        function applyRange(rangeKey) {
            const data = dataset[rangeKey] || dataset.monthly;
            const summary = data.summary || {};
            const trend = data.trend || {};
            const status = data.status_participation || {};
            const delivery = data.delivery_participation || {};
            const products = data.product_participation || [];

            el.orders.textContent = formatInt(summary.orders);
            el.ordersGrowth.textContent = summary.growth ? summary.growth.orders : 0;
            el.total.textContent = formatMoney(summary.order_total);
            el.revenueGrowth.textContent = summary.growth ? summary.growth.revenue : 0;
            el.subtotal.textContent = formatMoney(summary.subtotal);
            el.aov.textContent = new Intl.NumberFormat(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(summary.aov || 0);
            el.delivery.textContent = formatMoney(summary.delivery_total);
            el.cartOrders.textContent = formatInt(summary.cart_orders);
            el.deliveredRate.textContent = `${summary.delivered_rate || 0}%`;
            el.cancelledRate.textContent = `${summary.cancelled_rate || 0}%`;
            el.deliveredProgress.style.width = `${summary.delivered_rate || 0}%`;
            el.cancelledProgress.style.width = `${summary.cancelled_rate || 0}%`;
            el.itemsPerOrder.textContent = summary.avg_items_per_order || 0;
            el.activeRangeLabel.textContent = rangeLabels[rangeKey] || 'Monthly';

            trendChart.updateOptions({
                xaxis: { categories: labelsOrNA(trend.labels) },
                series: [
                    { name: 'Sales (Total)', type: 'line', data: seriesOrZero(trend.revenue) },
                    { name: 'Delivery Charge', type: 'line', data: seriesOrZero(trend.delivery) },
                    { name: 'Orders', type: 'line', data: seriesOrZero(trend.orders), yAxisIndex: 1 },
                ],
            });

            statusChart.updateOptions({
                labels: labelsOrNA(status.labels),
                series: seriesOrZero(status.series),
            });

            deliveryChart.updateOptions({
                xaxis: { categories: labelsOrNA(delivery.labels) },
                series: [{ name: 'Orders', data: seriesOrZero(delivery.series) }],
            });

            productChart.updateOptions({
                xaxis: { categories: products.length ? products.map(item => item.name) : ['N/A'] },
                series: [{ name: 'Quantity', data: products.length ? products.map(item => item.quantity) : [0] }],
            });

            document.querySelectorAll('.range-filter-btn').forEach((button) => {
                const isActive = button.dataset.range === rangeKey;
                button.classList.toggle('btn-primary', isActive);
                button.classList.toggle('btn-outline-primary', !isActive);
            });

            const url = new URL(window.location.href);
            url.searchParams.set('range', rangeKey);
            window.history.replaceState({}, '', url);
        }

        document.querySelectorAll('.range-filter-btn').forEach((button) => {
            button.addEventListener('click', function () {
                activeRange = this.dataset.range;
                applyRange(activeRange);
            });
        });

        applyRange(activeRange);
    });
</script>
@endpush
