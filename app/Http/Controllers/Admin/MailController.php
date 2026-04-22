<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function inbox()   { return view('admin.mail.inbox'); }
    public function details() { return view('admin.mail.details'); }
    public function compose() { return view('admin.mail.compose'); }
    public function outlook() { return view('admin.mail.outlook'); }
}
