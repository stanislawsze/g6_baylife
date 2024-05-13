<?php

use App\Http\Controllers\{ProfileController, DiscordRoleHandlerController, DashboardController, ConvoyController};
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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/list-users', [ProfileController::class, 'listUsers'])->name('list-users');
    Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::resource('/roles', DiscordRoleHandlerController::class);
    Route::get('/getDiscordRoles', [DiscordRoleHandlerController::class, 'getDiscordRoles']);
    Route::get('/webhook', [DiscordRoleHandlerController::class, 'webhook'])->name('webhook');
    Route::get('/timer', [DiscordRoleHandlerController::class, 'timer'])->name('timer');
    Route::resource('/convoy', ConvoyController::class);
    Route::get('/vehicles', [\App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles.index');
});
