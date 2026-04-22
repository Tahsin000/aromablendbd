<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class LayoutController extends Controller
{
    public function boxed()              { return view('admin.layouts-demo.boxed'); }
    public function compact()            { return view('admin.layouts-demo.compact'); }
    public function horizontal()         { return view('admin.layouts-demo.horizontal'); }
    public function preloader()          { return view('admin.layouts-demo.preloader'); }
    public function scrollable()         { return view('admin.layouts-demo.scrollable'); }
    public function sidebarCompact()     { return view('admin.layouts-demo.sidebar-compact'); }
    public function sidebarGradient()    { return view('admin.layouts-demo.sidebar-gradient'); }
    public function sidebarGray()        { return view('admin.layouts-demo.sidebar-gray'); }
    public function sidebarImage()       { return view('admin.layouts-demo.sidebar-image'); }
    public function sidebarLight()       { return view('admin.layouts-demo.sidebar-light'); }
    public function sidebarNoIcons()     { return view('admin.layouts-demo.sidebar-no-icons'); }
    public function sidebarOffcanvas()   { return view('admin.layouts-demo.sidebar-offcanvas'); }
    public function sidebarOnHover()     { return view('admin.layouts-demo.sidebar-on-hover'); }
    public function sidebarWithLines()   { return view('admin.layouts-demo.sidebar-with-lines'); }
    public function topbarDark()         { return view('admin.layouts-demo.topbar-dark'); }
    public function topbarGradient()     { return view('admin.layouts-demo.topbar-gradient'); }
    public function topbarGray()         { return view('admin.layouts-demo.topbar-gray'); }
}
