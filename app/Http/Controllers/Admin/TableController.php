<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TableController extends Controller
{
    public function static()               { return view('admin.tables.static'); }
    public function custom()               { return view('admin.tables.custom'); }
    public function datatablesBasic()      { return view('admin.tables.datatables-basic'); }
    public function datatablesAjax()       { return view('admin.tables.datatables-ajax'); }
    public function datatablesCheckbox()   { return view('admin.tables.datatables-checkbox-select'); }
    public function datatablesChildRows()  { return view('admin.tables.datatables-child-rows'); }
    public function datatablesColSearch()  { return view('admin.tables.datatables-column-searching'); }
    public function datatablesColumns()    { return view('admin.tables.datatables-columns'); }
    public function datatablesExport()     { return view('admin.tables.datatables-export-data'); }
    public function datatablesFixedCols()  { return view('admin.tables.datatables-fixed-columns'); }
    public function datatablesFixedHeader(){ return view('admin.tables.datatables-fixed-header'); }
    public function datatablesJS()         { return view('admin.tables.datatables-javascript'); }
    public function datatablesRange()      { return view('admin.tables.datatables-range-search'); }
    public function datatablesRendering()  { return view('admin.tables.datatables-rendering'); }
    public function datatablesRowsAdd()    { return view('admin.tables.datatables-rows-add'); }
    public function datatablesScroll()     { return view('admin.tables.datatables-scroll'); }
    public function datatablesSelect()     { return view('admin.tables.datatables-select'); }
}
