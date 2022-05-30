<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstrumentController;

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

Route::post('instruments/create', [InstrumentController::class, 'create'])->name('instruments.create');

Route::get('instruments/getAll', [InstrumentController::class, 'getAll'])->name('instruments.getAll');

Route::get('instruments/getCounters', [InstrumentController::class, 'getCounters'])->name('instruments.getCounters');

Route::post('instruments/buy/{id}', [InstrumentController::class, 'buy'])->name('instruments.buy');