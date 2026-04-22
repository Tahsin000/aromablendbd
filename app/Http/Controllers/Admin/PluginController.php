<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PluginController extends Controller
{
    public function sortable()     { return view('admin.plugins.sortable'); }
    public function pdfViewer()    { return view('admin.plugins.pdf-viewer'); }
    public function i18()          { return view('admin.plugins.i18'); }
    public function sweetAlerts()  { return view('admin.plugins.sweet-alerts'); }
    public function idleTimer()    { return view('admin.plugins.idle-timer'); }
    public function passMeter()    { return view('admin.plugins.pass-meter'); }
    public function masonry()      { return view('admin.plugins.masonry'); }
    public function animation()    { return view('admin.plugins.animation'); }
    public function tour()         { return view('admin.plugins.tour'); }
    public function treeView()     { return view('admin.plugins.tree-view'); }
    public function clipboard()    { return view('admin.plugins.clipboard'); }
    public function videoPlayer()  { return view('admin.plugins.video-player'); }
}
