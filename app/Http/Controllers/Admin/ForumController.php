<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function view() { return view('admin.forum.view'); }
    public function post() { return view('admin.forum.post'); }
}
