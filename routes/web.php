<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonController;

use App\Http\Controllers\{
  FeedbackController,
  CommentController,
  VoteController,
  NotificationController,
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

Route::get('/', [FeedbackController::class, 'list'])->name('home');

Route::get('/feedback', [FeedbackController::class, 'list'])->name('feedback.index');
Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');

Route::group(['middleware' => ['auth']], function ()
{
  Route::post('/feedback/{feedback_id}/comment/store', [CommentController::class, 'store'])->name('feedback.comment.store');
  Route::post('/feedback/{feedback_id}/vote/store', [VoteController::class, 'store'])->name('feedback.vote.store');

  Route::get('notifications', [NotificationController::class, 'getNotification'])->name('get_notification');
  Route::post('/notification/delete', [NotificationController::class, 'notificationDelete'])->name('notification.delete');
  Route::post('/notification/mark_as_read', [NotificationController::class, 'notificationMarkAsRead'])->name('notification.mark_as_read');
});
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth','role:user']], function ()
{
  // feedback Routes
  Route::resource('feedback', FeedbackController::class);
});


Route::group(['prefix' => 'admin','as' => 'admin.', 'middleware' => ['auth','role:admin']], function ()
{
  Route::get('/feedback', [FeedbackController::class, 'list'])->name('feedback');
  
  Route::get('/users', [UserManagementController::class, 'index'])->name('user.list');
  Route::post('/feedback/update_status/{id}', [FeedbackController::class, 'updateStatus'])->name('feedback.update_status');
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

