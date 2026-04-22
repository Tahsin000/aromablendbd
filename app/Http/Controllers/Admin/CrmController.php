<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CrmController extends Controller
{
    public function contacts()     { return view('admin.crm.contacts'); }
    public function opportunities(){ return view('admin.crm.opportunities'); }
    public function deals()        { return view('admin.crm.deals'); }
    public function leads()        { return view('admin.crm.leads'); }
    public function pipeline()     { return view('admin.crm.pipeline'); }
    public function campaign()     { return view('admin.crm.campaign'); }
    public function proposals()    { return view('admin.crm.proposals'); }
    public function estimations()  { return view('admin.crm.estimations'); }
    public function customers()    { return view('admin.crm.customers'); }
    public function activities()   { return view('admin.crm.activities'); }
}
