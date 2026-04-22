<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IconController extends Controller
{
    public function lucide()      { return view('admin.icons.lucide'); }
    public function remix()       { return view('admin.icons.remix'); }
    public function solarDuotone(){ return view('admin.icons.solar-duotone'); }
    public function tabler()      { return view('admin.icons.tabler'); }
    public function flags()       { return view('admin.icons.flags'); }
}
