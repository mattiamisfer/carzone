<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\BookingController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\Web\PakcageController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\StoreController;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Route::get('/check_query', function () {

   // return ;
    DB::enableQueryLog();
    $user =  User::with(['subscription'])->find(1);
    return $user->subscription->count();
        //  return DB::getQueryLog();
});


Route::get('/', function () {
    return view('front_end.index');
});
Auth::routes();
Route::get('/packages',[PakcageController::class,'index'])->name('package');
Route::get('/services/{id}',[ServiceController::class,'services'])->name('services');
Route::get('/about-us',[HomeController::class,'about'])->name('about');
Route::get('/service-centres',[HomeController::class,'services'])->name('centre');
Route::get('/events',[HomeController::class,'events'])->name('events');
Route::get('/contact-us',[HomeController::class,'contact'])->name('contact');
Route::get('/checkout',[HomeController::class,'proceed'])->name('checkout');
Route::get('/guest-login',[GuestController::class,'index'])->name('guest');

Route::get('/collections/igl-coating',[ProductController::class,'iglCollection'])->name('collection.igl');
Route::get('/collections/stek-automative',[ProductController::class,'stekCollection'])->name('collection.stek');



Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::post('/ajaxRequest', [AjaxController::class, 'cars'])->name('ajaxRequest.post');
 Route::resource('dashboard', DashboardController::class, ['names' => 'dashboard']);
 Route::resource('booking', BookingController::class, ['names' => 'booking']);


});
// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
 Route::resource('dashboard', AdminDashboardController::class,['names' => 'admin.dashboard']);

 Route::resource('category', CategoryController::class,['names' => 'admin.category']);
 Route::resource('package', PackageController::class,['names' => 'admin.package']);
 Route::resource('plans', PlansController::class,['names' => 'admin.plans']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
