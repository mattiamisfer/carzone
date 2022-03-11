<?php

use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedbackController;
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
use App\Http\Controllers\user\HistoryController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\Web\PakcageController;
use App\Http\Controllers\Web\PaymentController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\StoreController;
use App\Models\Feedback;
use App\Models\GuestCheckout;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.requests');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');



Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::get('/', function () {
  $testimonials = Feedback::with('user')->where('status','=','Active')
->orderBy('id','DESC')->get();
    return view('front_end.index',compact('testimonials'));
});


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


















Auth::routes(['verify' => true]);
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

Route::get('/collections/personal-car-care',[ProductController::class,'personal'])->name('collection.personal');


Route::group(['middleware' => ['auth', 'user','disable_back_btn','verified'], 'prefix' => 'user'], function () {
    Route::post('/ajaxRequest', [AjaxController::class, 'cars'])->name('ajaxRequest.post');
    Route::get('/ajaxRequestcars/{id}', [AjaxController::class, 'find_car_id'])->name('ajaxRequest.car.id');
 Route::resource('dashboard', DashboardController::class, ['names' => 'dashboard']);
 Route::delete('delete-booking/{id}',  [BookingController::class,'destroy'])->name('booking.destroy');

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

    Route::resource('booking-list', HistoryController::class,['names' => 'user.booking.list']);

});
// admin protected routes
Route::group(['middleware' => ['auth', 'admin','disable_back_btn'], 'prefix' => 'admin'], function () {
 Route::resource('dashboard', AdminDashboardController::class,['names' => 'admin.dashboard']);

 Route::resource('category', CategoryController::class,['names' => 'admin.category']);
 Route::resource('services', PackageController::class,['names' => 'admin.package']);
 Route::resource('packages', PlansController::class,['names' => 'admin.plans']);

 Route::resource('sub-category', SubCategoryController::class,['names' => 'admin.sub.category']);
 Route::get('/options-list/{id}',[OptionController::class,'options'])->name('admin.option.index');
 Route::get('/options/create/{id}',[OptionController::class,'options_add'])->name('admin.option.create');
Route::post('/options/store',[OptionController::class,'store'])->name('admin.option.store');
Route::get('/options/edit/{id}',[OptionController::class,'edit'])->name('admin.option.edit');
Route::put('/options/update/{id}',[OptionController::class,'update'])->name('admin.option.update');
Route::delete('/options/delete/{id}',[OptionController::class,'destroy'])->name('admin.option.delete');

Route::get('/subscriptions',[SubscriptionController::class,'index'])->name('admin.subscription.index');

Route::get('/bookings',[AdminBookingController::class,'index'])->name('admin.booking.index');


Route::get('holiday-calender', [HolidaysController::class, 'index'])->name('admin.holiday.calender');
Route::post('fullcalenderAjax', [HolidaysController::class, 'ajax']);


Route::post('/status/update/{id}',[AdminBookingController::class,'update'])->name('admin.status.update');

Route::post('/ajaxRequest_admin', [AjaxController::class, 'subcat'])->name('admin.ajaxRequest.post');

Route::get('/ajaxRequestcars/{id}', [AjaxController::class, 'find_car_id'])->name('admin.ajaxRequest.car.id');


Route::resource('feedbacks', AdminFeedbackController::class,['names' => 'admin.feedbacks']);


Route::post('/status/update_status/{id}',[AdminBookingController::class,'update_status'])->name('admin.status.update_status');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
