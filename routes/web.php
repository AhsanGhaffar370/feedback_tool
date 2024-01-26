<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\User\{
  HomeController
};

use App\Http\Controllers\{
  AuthController, 
  AdminController,
  FeedbackController,
  CommentController,
  VoteController,
};

use App\Http\Controllers\Admin\{
  UserManagementController, 
  UserPostManagementController,
  ProductController,
  CategoryController,
  BrandController,
  VehicleController,
  PlanController,
  ContactManagementController,
};
use Illuminate\Http\Request;

Auth::routes();
//['verify' => true]

// Route::get('/stripe_hook', [SubscriptionController::class, 'stripe_hook'])->name('stripe_hook');

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::get('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/login', [AuthController::class, 'loginCheck'])->name('login_check');

Route::get('/register', [AuthController::class, 'userRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeUserRegister'])->name('store.user.register');
Route::post('mechanic/register', [AuthController::class, 'storeMechanicRegister'])->name('store.mechanic.register');

Route::get('/feedback', [FeedbackController::class, 'list'])->name('feedback.index');
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
Route::post('/feedback/{feedback_id}/comment/store', [CommentController::class, 'store'])->name('feedback.comment.store');
Route::post('/feedback/{feedback_id}/vote/store', [VoteController::class, 'store'])->name('feedback.vote.store');

Route::group(['middleware' => ['auth']], function ()
{
  Route::get('notifications', [HomeController::class, 'getNotification'])->name('get_notification');
  Route::post('/notification/delete', [HomeController::class, 'notificationDelete'])->name('notification.delete');
  Route::post('/notification/mark_as_read', [HomeController::class, 'notificationMarkAsRead'])->name('notification.mark_as_read');
});
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth','role:user']], function ()
{
  Route::get('/chat', [HomeController::class, 'chat'])->name('chat');

  Route::get('/dashboard', [AuthController::class, 'userDashboard'])->name('dashboard');
  

  // feedback Routes
  Route::resource('feedback', FeedbackController::class);


  Route::get('/reset-password', [AuthController::class, 'editPassword'])->name('edit_password');
  Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('update_password');

});


Route::group(['prefix' => 'admin','as' => 'admin.', 'middleware' => ['auth','role:admin']], function ()
{
  Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
  
  Route::get('/user-list', [UserManagementController::class, 'userList'])->name('user.list');
  Route::post('/feedback/update_status/{id}', [FeedbackController::class, 'feedbackUpdateStatus'])->name('feedback.update_status');

 
  Route::get('/account-details', [AuthController::class, 'adminAccountDetails'])->name('account_details');
  Route::post('/account-details/update/', [AuthController::class, 'updateAdminAccountDetails'])->name('update.account_details');

});

Route::get('/storage-link', function() {
  Artisan::call('storage:link');
});
Route::get('/cache-clear', function() {
  Artisan::call('optimize:clear');
});
Route::get('/stripe-webhook', function() {
  Artisan::call('cashier:webhook');
});

