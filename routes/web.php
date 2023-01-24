<?php

use App\Http\Controllers\WhatsappController;
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
})->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/search', [App\Repository\CustomerRepository::class, 'getCustomerName'])->name('customer.search');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::resource('customer', 'App\Http\Controllers\CustomerController')->middleware('verified');

Route::resource('task', 'App\Http\Controllers\TaskController')->middleware('verified');

Route::put('task/{task}/done', [App\Http\Controllers\TaskController::class, 'done'])->middleware('verified')->name('task.done');

Route::post('whatsapp', [App\Http\Controllers\WhatsappController::class, 'sendMessage'])->middleware('verified')->name('whatsapp');

Route::resource('toReceive', 'App\Http\Controllers\ToReceiveController')->middleware('verified')->except('create', 'store','edit', 'show');

Route::resource('expense', 'App\Http\Controllers\ExpenseController')->middleware('verified');

Route::resource('expenseToPay', 'App\Http\Controllers\ExpenseToPayController')->middleware('verified')->except('show');
