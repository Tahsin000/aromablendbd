<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class EcommerceController extends Controller
{
    public function products()       { return view('admin.ecommerce.products'); }
    public function productsGrid()   { return view('admin.ecommerce.products-grid'); }
    public function productDetails() { return view('admin.ecommerce.product-details'); }
    public function productAdd()     { return view('admin.ecommerce.product-add'); }
    public function categories()     { return view('admin.ecommerce.categories'); }
    public function orders()         { return view('admin.ecommerce.orders'); }
    public function orderDetails()   { return view('admin.ecommerce.order-details'); }
    public function orderAdd()       { return view('admin.ecommerce.order-add'); }
    public function customers()      { return view('admin.ecommerce.customers'); }
    public function cart()           { return view('admin.ecommerce.cart'); }
    public function checkout()       { return view('admin.ecommerce.checkout'); }
    public function sellers()        { return view('admin.ecommerce.sellers'); }
    public function sellerDetails()  { return view('admin.ecommerce.seller-details'); }
    public function refunds()        { return view('admin.ecommerce.refunds'); }
    public function reviews()        { return view('admin.ecommerce.reviews'); }
    public function warehouse()      { return view('admin.ecommerce.warehouse'); }
    public function stocks()         { return view('admin.ecommerce.product-stocks'); }
    public function purchasedOrders(){ return view('admin.ecommerce.purchased-orders'); }
    public function productViews()   { return view('admin.ecommerce.product-views'); }
    public function sales()          { return view('admin.ecommerce.sales'); }
    public function attributes()     { return view('admin.ecommerce.attributes'); }
    public function discountEdit()   { return view('admin.ecommerce.discount-edit'); }
    public function settings()       { return view('admin.ecommerce.settings'); }
}
