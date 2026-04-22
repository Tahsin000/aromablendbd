<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function grid()      { return view('admin.projects.grid'); }
    public function list()      { return view('admin.projects.list'); }
    public function details()   { return view('admin.projects.details'); }
    public function kanban()    { return view('admin.projects.kanban'); }
    public function teamBoard() { return view('admin.projects.team-board'); }
    public function activity()  { return view('admin.projects.activity'); }
}
