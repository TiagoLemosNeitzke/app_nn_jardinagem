<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/search', [App\Repository\CustomerRepository::class, 'getCustomerName'])->name('customer.search');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::resource('customer', 'App\Http\Controllers\CustomerController')->middleware('verified');

Route::resource('task', 'App\Http\Controllers\TaskController')->middleware('verified');

Route::resource('toReceive', 'App\Http\Controllers\ToReceiveController')->middleware('verified')->except('create');

/* Route::post('/searchCustomer', function () {
    if (request()->name) {
        $customer = \App\Models\Customer::where('name', request()->name)->get()->toArray();
    }

    if (request()->customer_id) {
        $customer = \App\Models\Customer::where('id', request()->customer_id)->get()->toArray();
        return 
    }
    //dd($customer[0]);
})->name('searchCustomer'); */
