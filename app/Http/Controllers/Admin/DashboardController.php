<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function ecommerce()
    {
        return view('admin.dashboard.ecommerce');
    }

    public function analytics()
    {
        return view('admin.dashboard.analytics');
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
}
