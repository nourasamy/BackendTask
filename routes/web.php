<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;


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


Auth::routes();
    Route::get('/', function () {
        return view('welcome');
    });                        
 Route::middleware(['auth'])->group(function () {

    Route::resource('company', CompaniesController::class)->except('show');
    Route::resource('employee', EmployeesController::class)->except('show');
    Route::get('filter',[EmployeesController::class, 'filter'])->name('filter');

 });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
