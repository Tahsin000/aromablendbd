<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function contacts()        { return view('admin.users.contacts'); }
    public function profile()         { return view('admin.users.profile'); }
    public function accountSettings() { return view('admin.users.account-settings'); }
    public function roles()           { return view('admin.users.roles'); }
    public function roleDetails()     { return view('admin.users.role-details'); }
    public function permissions()     { return view('admin.users.permissions'); }
}
