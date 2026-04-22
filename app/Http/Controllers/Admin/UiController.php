<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UiController extends Controller
{
    public function accordions()   { return view('admin.ui.accordions'); }
    public function alerts()       { return view('admin.ui.alerts'); }
    public function badges()       { return view('admin.ui.badges'); }
    public function breadcrumb()   { return view('admin.ui.breadcrumb'); }
    public function buttons()      { return view('admin.ui.buttons'); }
    public function cards()        { return view('admin.ui.cards'); }
    public function carousel()     { return view('admin.ui.carousel'); }
    public function collapse()     { return view('admin.ui.collapse'); }
    public function colors()       { return view('admin.ui.colors'); }
    public function dropdowns()    { return view('admin.ui.dropdowns'); }
    public function grid()         { return view('admin.ui.grid'); }
    public function images()       { return view('admin.ui.images'); }
    public function links()        { return view('admin.ui.links'); }
    public function listGroup()    { return view('admin.ui.list-group'); }
    public function modals()       { return view('admin.ui.modals'); }
    public function notifications(){ return view('admin.ui.notifications'); }
    public function offcanvas()    { return view('admin.ui.offcanvas'); }
    public function pagination()   { return view('admin.ui.pagination'); }
    public function placeholders() { return view('admin.ui.placeholders'); }
    public function popovers()     { return view('admin.ui.popovers'); }
    public function progress()     { return view('admin.ui.progress'); }
    public function scrollspy()    { return view('admin.ui.scrollspy'); }
    public function spinners()     { return view('admin.ui.spinners'); }
    public function tabs()         { return view('admin.ui.tabs'); }
    public function tooltips()     { return view('admin.ui.tooltips'); }
    public function typography()   { return view('admin.ui.typography'); }
    public function utilities()    { return view('admin.ui.utilities'); }
    public function videos()       { return view('admin.ui.videos'); }
}
