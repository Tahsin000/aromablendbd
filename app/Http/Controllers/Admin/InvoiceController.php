<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function list()    { return view('admin.invoice.list'); }
    public function details() { return view('admin.invoice.details'); }
    public function create()  { return view('admin.invoice.create'); }
}
