<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class WidgetController extends Controller
{
    public function charts()    { return view('admin.widgets.charts'); }
    public function mixed()     { return view('admin.widgets.mixed'); }
    public function social()    { return view('admin.widgets.social'); }
    public function statistics(){ return view('admin.widgets.statistics'); }
    public function weather()   { return view('admin.widgets.weather'); }
}
