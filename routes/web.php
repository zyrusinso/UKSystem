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
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/calculator', [App\Http\Controllers\PilotController::class, 'calculator'])->name('calculator');


Route::middleware('admin')->prefix('admin')->group(function() {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->name('admin.home');
});


Route::middleware('auth')->prefix('diamond')->group(function() {
    Route::get('/', [App\Http\Controllers\DiamondController::class, 'index'])->name('diamond.index');
    Route::post('/', [App\Http\Controllers\DiamondController::class, 'store'])->name('diamond.store');
    Route::get('/{id}', [App\Http\Controllers\DiamondController::class, 'show'])->name('diamond.show');
    Route::patch('/{id}', [App\Http\Controllers\DiamondController::class, 'update'])->name('diamond.update');

});
Route::middleware('auth')->prefix('reseller')->group(function() {
    Route::get('/', [App\Http\Controllers\ResellerController::class, 'index'])->name('reseller.index');
    Route::post('/', [App\Http\Controllers\ResellerController::class, 'store'])->name('reseller.store');
    Route::get('/{id}', [App\Http\Controllers\ResellerController::class, 'show'])->name('reseller.show');
    Route::patch('/{id}', [App\Http\Controllers\ResellerController::class, 'update'])->name('reseller.update');

});
Route::middleware('auth')->prefix('pilot')->group(function() {
    Route::get('/', [App\Http\Controllers\PilotController::class, 'index'])->name('pilot.index');
    Route::post('/', [App\Http\Controllers\PilotController::class, 'store'])->name('pilot.store');
    Route::get('/{id}', [App\Http\Controllers\PilotController::class, 'show'])->name('pilot.show');
    Route::patch('/{id}', [App\Http\Controllers\PilotController::class, 'update'])->name('pilot.update');

});
Route::middleware('auth')->prefix('normal_gifting')->group(function() {
    Route::get('/', [App\Http\Controllers\NormalController::class, 'index'])->name('normal.index');
    Route::post('/', [App\Http\Controllers\NormalController::class, 'store'])->name('normal.store');
    Route::get('/{id}', [App\Http\Controllers\NormalController::class, 'show'])->name('normal.show');
    Route::patch('/{id}', [App\Http\Controllers\NormalController::class, 'update'])->name('normal.update');

});
Route::middleware('auth')->prefix('skin')->group(function() {
    Route::get('/', [App\Http\Controllers\SkinController::class, 'index'])->name('skin.index');
    Route::post('/', [App\Http\Controllers\SkinController::class, 'store'])->name('skin.store');

});
Route::middleware('auth')->prefix('pre_order_diamond')->group(function() {
    Route::get('/', [App\Http\Controllers\OrderDiamondController::class, 'index'])->name('order_diamond.index');
    Route::post('/', [App\Http\Controllers\OrderDiamondController::class, 'store'])->name('order_diamond.store');

});
Route::middleware('auth')->prefix('pre_order_starlight')->group(function() {
    Route::get('/', [App\Http\Controllers\StarlightController::class, 'index'])->name('starlight.index');
    Route::post('/', [App\Http\Controllers\StarlightController::class, 'store'])->name('starlight.store');

});
Route::middleware('auth')->prefix('vip_diamonds')->group(function() {
    Route::get('/', [App\Http\Controllers\VIPController::class, 'index'])->name('vip.index');
    Route::post('/', [App\Http\Controllers\VIPController::class, 'store'])->name('vip.store');

});
Route::middleware('auth')->prefix('premium_diamonds')->group(function() {
    Route::get('/', [App\Http\Controllers\PreDiamondController::class, 'index'])->name('pre_diamond.index');
    Route::post('/', [App\Http\Controllers\PreDiamondController::class, 'store'])->name('pre_diamond.store');

});





