<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PromoController extends Controller
{
    public function coupons()   { return view('admin.promo.coupons'); }
    public function giftCards() { return view('admin.promo.gift-cards'); }
    public function discounts() { return view('admin.promo.discounts'); }
}
