<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function list()    { return view('admin.blog.list'); }
    public function grid()    { return view('admin.blog.grid'); }
    public function article() { return view('admin.blog.article'); }
    public function add()     { return view('admin.blog.add'); }
}
