<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    // Apex Charts
    public function apexArea()       { return view('admin.charts.apex-area'); }
    public function apexBar()        { return view('admin.charts.apex-bar'); }
    public function apexBoxplot()    { return view('admin.charts.apex-boxplot'); }
    public function apexBubble()     { return view('admin.charts.apex-bubble'); }
    public function apexCandlestick(){ return view('admin.charts.apex-candlestick'); }
    public function apexColumn()     { return view('admin.charts.apex-column'); }
    public function apexFunnel()     { return view('admin.charts.apex-funnel'); }
    public function apexHeatmap()    { return view('admin.charts.apex-heatmap'); }
    public function apexLine()       { return view('admin.charts.apex-line'); }
    public function apexMixed()      { return view('admin.charts.apex-mixed'); }
    public function apexPie()        { return view('admin.charts.apex-pie'); }
    public function apexPolarArea()  { return view('admin.charts.apex-polar-area'); }
    public function apexRadar()      { return view('admin.charts.apex-radar'); }
    public function apexRadialbar()  { return view('admin.charts.apex-radialbar'); }
    public function apexRange()      { return view('admin.charts.apex-range'); }
    public function apexScatter()    { return view('admin.charts.apex-scatter'); }
    public function apexSlope()      { return view('admin.charts.apex-slope'); }
    public function apexSparklines() { return view('admin.charts.apex-sparklines'); }
    public function apexTimeline()   { return view('admin.charts.apex-timeline'); }
    public function apexTreemap()    { return view('admin.charts.apex-treemap'); }

    // ChartJS
    public function chartjsArea()  { return view('admin.charts.chartjs-area'); }
    public function chartjsBar()   { return view('admin.charts.chartjs-bar'); }
    public function chartjsLine()  { return view('admin.charts.chartjs-line'); }
    public function chartjsOther() { return view('admin.charts.chartjs-other'); }

    // ECharts
    public function echartArea()        { return view('admin.charts.echart-area'); }
    public function echartBar()         { return view('admin.charts.echart-bar'); }
    public function echartCandlestick() { return view('admin.charts.echart-candlestick'); }
    public function echartGauge()       { return view('admin.charts.echart-gauge'); }
    public function echartGeoMap()      { return view('admin.charts.echart-geo-map'); }
    public function echartHeatmap()     { return view('admin.charts.echart-heatmap'); }
    public function echartLine()        { return view('admin.charts.echart-line'); }
    public function echartOther()       { return view('admin.charts.echart-other'); }
    public function echartPie()         { return view('admin.charts.echart-pie'); }
    public function echartRadar()       { return view('admin.charts.echart-radar'); }
    public function echartScatter()     { return view('admin.charts.echart-scatter'); }
}
