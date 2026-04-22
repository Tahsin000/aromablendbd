<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    // Basic style
    public function signIn()        { return view('admin.auth.sign-in'); }
    public function signUp()        { return view('admin.auth.sign-up'); }
    public function lockScreen()    { return view('admin.auth.lock-screen'); }
    public function resetPass()     { return view('admin.auth.reset-pass'); }
    public function newPass()       { return view('admin.auth.new-pass'); }
    public function loginPin()      { return view('admin.auth.login-pin'); }
    public function twoFactor()     { return view('admin.auth.two-factor'); }
    public function successMail()   { return view('admin.auth.success-mail'); }
    public function deleteAccount() { return view('admin.auth.delete-account'); }

    // Card style
    public function cardSignIn()        { return view('admin.auth.card-sign-in'); }
    public function cardSignUp()        { return view('admin.auth.card-sign-up'); }
    public function cardLockScreen()    { return view('admin.auth.card-lock-screen'); }
    public function cardResetPass()     { return view('admin.auth.card-reset-pass'); }
    public function cardNewPass()       { return view('admin.auth.card-new-pass'); }
    public function cardLoginPin()      { return view('admin.auth.card-login-pin'); }
    public function cardTwoFactor()     { return view('admin.auth.card-two-factor'); }
    public function cardSuccessMail()   { return view('admin.auth.card-success-mail'); }
    public function cardDeleteAccount() { return view('admin.auth.card-delete-account'); }

    // Split style
    public function splitSignIn()        { return view('admin.auth.split-sign-in'); }
    public function splitSignUp()        { return view('admin.auth.split-sign-up'); }
    public function splitLockScreen()    { return view('admin.auth.split-lock-screen'); }
    public function splitResetPass()     { return view('admin.auth.split-reset-pass'); }
    public function splitNewPass()       { return view('admin.auth.split-new-pass'); }
    public function splitLoginPin()      { return view('admin.auth.split-login-pin'); }
    public function splitTwoFactor()     { return view('admin.auth.split-two-factor'); }
    public function splitSuccessMail()   { return view('admin.auth.split-success-mail'); }
    public function splitDeleteAccount() { return view('admin.auth.split-delete-account'); }
}
