<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Session, Hash,URL,Storage,Validator,Auth};
use Carbon\Carbon;
use App\Models\{
  Feedback,
  Comment,
  Notification
};
use App\Traits\NotificationTrait;
class CommentController extends Controller
{
  use NotificationTrait;

    public function store(Request $request, $feedback_id)
    {
      $validator = Validator::make($request->all(), [
        'content' => "required",
      ]);
      if ($validator->fails()) {
        return back()->withInput()->withErrors($validator->errors());
      }

      try{
        DB::beginTransaction();

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['feedback_id'] = $feedback_id;

        $comment = Comment::create($input);

        DB::commit();

        // send notification
        $feedback_details = Feedback::find($feedback_id);
        $notification_msg = Auth::user()->name.' wrote a comment on your feedback.';
        $url  = '/feedback/'.$feedback_details->id;
        $this->notify_user($feedback_details->user_id, $url, $notification_msg);

        return redirect()->back()->withSuccess('Comment Posted Successfully!');
      }
      catch (\Exception $e){
        DB::rollback();
        dd($e);
        return redirect()->back()->withError('Something went wrong!');
      }
    }
}
