<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\HolidaysController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\user\BookingController;
use App\Http\Controllers\user\DashboardController;
use App\Http\Controllers\user\FeedbackController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\Web\PakcageController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\StoreController;
use App\Models\GuestCheckout;
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
Route::get('/checkout/{id}/{type}',[HomeController::class,'proceed'])->name('checkout');
Route::get('/guest-purchase',[GuestController::class,'index'])->name('guest');
Route::post('/guest-checkout',[GuestController::class,'store'])->name('guest.store');
Route::get('/guest-pay',[GuestController::class,'guest_pay']);

Route::post('/guest-payment',[GuestController::class,'response'])->name('guest.response');

Route::get('/payment-guest/{id}', [GuestController::class, 'payme'])->name('guest.payment');
Route::post('/indipay/response',[PaymentController::class,'response'])->name('payment.response');

Route::get('/payment-failed', [GuestController::class, 'failed'])->name('guest.failed');
Route::get('/refund-cancellation-policy', [HomeController::class, 'refund'])->name('web.refund');
Route::get('/terms-and-conditions', [HomeController::class, 'terms'])->name('web.terms');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('web.privacy');
Route::post('/contact', [HomeController::class, 'store'])->name('web.contact');





Route::get('/collections/igl-coating',[ProductController::class,'iglCollection'])->name('collection.igl');
Route::get('/collections/stek-automative',[ProductController::class,'stekCollection'])->name('collection.stek');



Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::post('/ajaxRequest', [AjaxController::class, 'cars'])->name('ajaxRequest.post');
 Route::resource('dashboard', DashboardController::class, ['names' => 'dashboard']);
 Route::resource('booking', BookingController::class, ['names' => 'booking']);
 Route::get('/checkout/{id}',[PaymentController::class,'checkout'])->name('user.checkout');

 Route::post('/payment-status',[PaymentController::class,'status'])->name('user.status');
 Route::get('/profile',[ProfileController::class,'profile'])->name('user.profile');
 Route::post('/stores',[ProfileController::class,'store'])->name('user.profile.save');
 Route::get('/payment/{id}', [PaymentController::class, 'payment'])->name('api.statuss');
 Route::resource('transactions', TransactionsController::class,['names' => 'user.transactions']);

 Route::get('post', [PostController::class,'create'])->name('post.create');
 Route::post('post',  [PostController::class,'store'])->name('post.store');
 Route::get('/posts',   [PostController::class,'index'])->name('posts');
 Route::get('/article/{id}',  [PostController::class,'show'])->name('post.show');
 Route::post('/comment/store', [CommentController::class,'store'])->name('comment.add');
 Route::post('/reply/store', [CommentController::class,'replyStore'])->name('reply.add');
 Route::get('/payment-failed', [PaymentController::class, 'failed'])->name('api.failed');

 Route::get('/feedback', [FeedbackController::class, 'index'])->name('user.feedback');

 Route::post('/store', [FeedbackController::class, 'store'])->name('user.feedback.store');

    Route::get('/holiday',[AjaxController::class,'ajax_get_holidays']);

});
// admin protected routes
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
 Route::resource('dashboard', AdminDashboardController::class,['names' => 'admin.dashboard']);

 Route::resource('category', CategoryController::class,['names' => 'admin.category']);
 Route::resource('package', PackageController::class,['names' => 'admin.package']);
 Route::resource('plans', PlansController::class,['names' => 'admin.plans']);

 Route::resource('sub-category', SubCategoryController::class,['names' => 'admin.sub.category']);
 Route::get('/options-list/{id}',[OptionController::class,'options'])->name('admin.option.index');
 Route::get('/options/create/{id}',[OptionController::class,'options_add'])->name('admin.option.create');
Route::post('/options/store',[OptionController::class,'store'])->name('admin.option.store');
Route::get('/options/edit/{id}',[OptionController::class,'edit'])->name('admin.option.edit');
Route::put('/options/update/{id}',[OptionController::class,'update'])->name('admin.option.update');
Route::delete('/options/delete/{id}',[OptionController::class,'destroy'])->name('admin.option.delete');

Route::get('/subscriptions',[SubscriptionController::class,'index'])->name('admin.subscription.index');

Route::get('/bookings',[AdminBookingController::class,'index'])->name('admin.booking.index');


Route::get('holiday-calender', [HolidaysController::class, 'index']);
Route::post('fullcalenderAjax', [HolidaysController::class, 'ajax']);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
