<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\user\BookingController;
use App\Http\Controllers\Web\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/callback-guest', [GuestController::class, 'status'])->name('api.guest.status');

Route::post('/callback', [PaymentController::class, 'status'])->name('api.status');
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
//     Route::post('/ajaxRequest', [AjaxController::class, 'cars'])->name('ajaxRequest.post');
//  Route::resource('dashboard', DashboardController::class, ['names' => 'dashboard']);



});
Route::resource('booking', BookingController::class, ['names' => 'booking']);
