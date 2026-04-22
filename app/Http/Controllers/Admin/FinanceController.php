<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function expenses()        { return view('admin.finance.expenses'); }
    public function expenseCategory() { return view('admin.finance.expense-category'); }
    public function income()          { return view('admin.finance.income'); }
    public function transactions()    { return view('admin.finance.transactions'); }
    public function banksCards()      { return view('admin.finance.banks-cards'); }
}
