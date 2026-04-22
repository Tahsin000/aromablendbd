<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function google()  { return view('admin.maps.google'); }
    public function leaflet() { return view('admin.maps.leaflet'); }
    public function vector()  { return view('admin.maps.vector'); }
}
