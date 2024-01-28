<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Session, Hash,URL,Storage,Validator,Auth};
use Carbon\Carbon;
use App\Models\{
  Feedback,
  Notification
};
use App\Traits\NotificationTrait;

class NotificationController extends Controller
{
  use NotificationTrait;
    
  function getNotification() {
    try {
      $notifications = Notification::where('user_id', Auth::id())->where('seen', 0)->get();

      return view('front.notifications', compact('notifications')); 
    }
    catch (\Exception $e) {
      dd($e);
      return redirect()->back()->withError('something went wrong');
    }
  }

  
  public function notificationMarkAsRead(Request $request)
  {
    try {
      DB::beginTransaction();

      $notification = Notification::find($request->get('id'))->update([
        'seen' => 1
      ]);

      DB::commit();
      
      return response()->json(['code' => 200, 'msg' => 'Notification mark as read successfully']);
    }
    catch(\Exception $e) {
      DB::rollback();
      dd($e);
      return response()->json(['code' => 500, 'msg' => 'Something went wrong!']);
    }
  }

  public function notificationDelete(Request $request)
  {
    try {
      DB::beginTransaction();

      $notification = Notification::find($request->get('id'))->delete();

      DB::commit();
      
      return response()->json(['code' => 200, 'msg' => 'Notification deleted successfully']);
    }
    catch(\Exception $e) {
      DB::rollback();
      dd($e);
      return response()->json(['code' => 500, 'msg' => 'Something went wrong!']);
    }
  }
}
