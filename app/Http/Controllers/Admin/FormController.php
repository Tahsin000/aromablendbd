<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function elements()     { return view('admin.forms.elements'); }
    public function layout()       { return view('admin.forms.layout'); }
    public function select()       { return view('admin.forms.select'); }
    public function fileuploads()  { return view('admin.forms.fileuploads'); }
    public function wizard()       { return view('admin.forms.wizard'); }
    public function validation()   { return view('admin.forms.validation'); }
    public function pickers()      { return view('admin.forms.pickers'); }
    public function rangeSlider()  { return view('admin.forms.range-slider'); }
    public function textEditors()  { return view('admin.forms.text-editors'); }
    public function otherPlugin()  { return view('admin.forms.other-plugin'); }
    public function cropper()      { return view('admin.forms.cropper'); }
}
