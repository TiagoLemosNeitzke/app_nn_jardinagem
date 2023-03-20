<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsappController;

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

Route::get('/search', [App\Repository\CustomerRepository::class, 'customerSearch'])->name('customer.search');

Route::group(['middleware' => ['verified']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('customer', 'App\Http\Controllers\CustomerController');

    Route::resource('task', 'App\Http\Controllers\TaskController')->except('show');

    Route::put('task/{task}/done', [App\Http\Controllers\TaskController::class, 'done'])->name('task.done');

    Route::post('whatsapp', [App\Http\Controllers\WhatsappController::class, 'sendMessage'])->name('whatsapp');

    Route::resource('toReceive', 'App\Http\Controllers\ToReceiveController')->except('create', 'store', 'edit', 'show');

    Route::resource('expense', 'App\Http\Controllers\ExpenseController');

    Route::resource('expenseToPay', 'App\Http\Controllers\ExpenseToPayController')->except('show');
});
