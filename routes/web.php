<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChargeController;
//use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('index');
});

Route::get('/notes', function () {
    return view('notes');
});

Route::get('/privacypolicy', function () {
    return view('privacypolicy');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/check', function () {
    return view('check');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/mypage', function () {
        return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/device-entry', function () {
    return view('device-entry');
});

Route::get('/device-check', function () {
    return view('device-check');
});

Route::get('/device-checkout', function () {
    return view('device-checkout');
});

Route::get('/device-comp', function () {
    return view('device-comp');
});

Route::get('/header', function () {
    return view('header');
});

Route::get('/ham-header', function () {
    return view('ham-header');
});

Route::get('/footer', function () {
    return view('footer');
});

Route::get('/complet', function () {
    return view('complet');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/claimcomplet', function () {
    return view('claimcomplet');
});

Route::get('/contractchange', function () {
    return view('contractchange');
});

Route::get('/contractchange-check', function () {
    return view('contractchange-check');
});

Route::get('/cancel', function () {
    return view('cancel');
});

Route::get('/cancel-comp', function () {
    return view('cancel-comp');
});

Route::get('/changepayment', function () {
    return view('changepayment');
});


Route::post('/check', [App\Http\Controllers\Controller::class, 'check'])->name('check');
Route::post('/checkout', [App\Http\Controllers\Controller::class, 'checkout'])->name('checkout');

Route::post('/devicecheck', [App\Http\Controllers\HomeController::class, 'devicecheck'])->name('devicecheck');
Route::post('/contractchangecheck', [App\Http\Controllers\HomeController::class, 'contractchangecheck'])->name('contractchangecheck')->middleware('auth');
Route::get('/claim', [App\Http\Controllers\HomeController::class, 'claim'])->name('claim')->middleware('auth');
Route::get('/complet', [App\Http\Controllers\HomeController::class, 'complet'])->name('complet')->middleware('auth');
Route::get('/claimcomplet', [App\Http\Controllers\HomeController::class, 'claimcomplet'])->name('claimcomplet')->middleware('auth');
Route::post('/confirmation', [App\Http\Controllers\HomeController::class, 'confirmation'])->middleware('auth');


Auth::routes();
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(ChargeController::class)->group(function(){
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
  //  Route::post('ChargeController', 'store')->name('store');
    Route::post('devicePost', 'devicePost')->name('device.post');
    Route::post('chengePost', 'chengePost')->name('chengepost');
    Route::post('chengePayment', 'chengePayment')->name('chengepayment');
    Route::post('claimPost', 'claimPost')->name('claimpost');
    Route::get('deviceDelete', 'deviceDelete')->name('devicedelete');
    Route::get('AccountCancel', 'AccountCancel')->name('AccountCancel');
});
