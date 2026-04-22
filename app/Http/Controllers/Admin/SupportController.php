<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function ticketList()    { return view('admin.support.ticket-list'); }
    public function ticketDetails() { return view('admin.support.ticket-details'); }
    public function ticketCreate()  { return view('admin.support.ticket-create'); }
}
