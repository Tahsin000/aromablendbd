<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AppsController extends Controller
{
    public function chat()         { return view('admin.apps.chat'); }
    public function socialFeed()   { return view('admin.apps.social-feed'); }
    public function proAI()        { return view('admin.apps.pro-ai'); }
    public function fileManager()  { return view('admin.apps.file-manager'); }
    public function calendar()     { return view('admin.apps.calendar'); }
    public function companies()    { return view('admin.apps.companies'); }
    public function todo()         { return view('admin.apps.todo'); }
    public function pinBoard()     { return view('admin.apps.pin-board'); }
    public function clients()      { return view('admin.apps.clients'); }
    public function voteList()     { return view('admin.apps.vote-list'); }
    public function issueTracker() { return view('admin.apps.issue-tracker'); }
    public function apiKeys()      { return view('admin.apps.api-keys'); }
    public function manage()       { return view('admin.apps.manage'); }
}
