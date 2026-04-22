<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function aboutUs()          { return view('admin.pages.about-us'); }
    public function contactUs()        { return view('admin.pages.contact-us'); }
    public function pricing()          { return view('admin.pages.pricing'); }
    public function empty()            { return view('admin.pages.empty'); }
    public function timeline()         { return view('admin.pages.timeline'); }
    public function gallery()          { return view('admin.pages.gallery'); }
    public function faq()              { return view('admin.pages.faq'); }
    public function sitemap()          { return view('admin.pages.sitemap'); }
    public function searchResults()    { return view('admin.pages.search-results'); }
    public function comingSoon()       { return view('admin.pages.coming-soon'); }
    public function privacyPolicy()    { return view('admin.pages.privacy-policy'); }
    public function termsConditions()  { return view('admin.pages.terms-conditions'); }
    public function usersProfile()     { return view('admin.pages.users-profile'); }
}
