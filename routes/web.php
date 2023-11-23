<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CalculateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/calculator', function () {
    return view('welcome');
});

Route::get('/index', [CalculateController::class, 'index'])->name('index');
Route::post('/calculate', [CalculateController::class, 'calculate'])->name('calculate');

Route::delete('/delete-calculation/{id}', [CalculateController::class, 'deleteCalculation'])->name('deleteCalculation');
