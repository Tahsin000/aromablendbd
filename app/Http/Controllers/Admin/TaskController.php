<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function list()    { return view('admin.tasks.list'); }
    public function details() { return view('admin.tasks.details'); }
    public function create()  { return view('admin.tasks.create'); }
}
