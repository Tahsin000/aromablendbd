<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HrmController extends Controller
{
    public function staffs()           { return view('admin.hrm.staffs'); }
    public function staffProfile()     { return view('admin.hrm.staff-profile'); }
    public function staffAdd()         { return view('admin.hrm.staff-add'); }
    public function departments()      { return view('admin.hrm.departments'); }
    public function attendance()       { return view('admin.hrm.attendance'); }
    public function leaves()           { return view('admin.hrm.leaves'); }
    public function leaveAdd()         { return view('admin.hrm.leave-add'); }
    public function holidays()         { return view('admin.hrm.holidays'); }
    public function payroll()          { return view('admin.hrm.payroll'); }
    public function createSalarySlip() { return view('admin.hrm.create-salary-slip'); }
}
