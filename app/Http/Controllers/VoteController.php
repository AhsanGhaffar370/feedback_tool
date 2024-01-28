<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Session, Hash,URL,Storage,Validator,Auth};
use Carbon\Carbon;
use App\Models\{
  Feedback,
  Vote
};
use App\Traits\NotificationTrait;
class VoteController extends Controller
{
  use NotificationTrait;

    public function store(Request $request, $feedback_id)
    {
      $validator = Validator::make($request->all(), [
        'is_like' => "required",
      ]);
      if ($validator->fails()) {
        return back()->withInput()->withErrors($validator->errors());
      }

      try{

        if(!Auth::check()) {
            return redirect()->back()->withError('Login to vote on this post!');
        }
        DB::beginTransaction();

        $input = $request->only(['is_like']);
        $input['user_id'] = Auth::id();
        $input['feedback_id'] = $feedback_id;

        $vote_details = Vote::where('user_id', Auth::id())->where('feedback_id', $feedback_id)->first();

        if($vote_details != null ) {
            $vote_details->update([
                'is_like' => $request->is_like
            ]);
        }
        else {
            Vote::create($input);
        }
        
        DB::commit();

        // send notification
        $feedback_details = Feedback::find($feedback_id);
        $notification_msg = Auth::user()->name. (($request->is_like == 1) ? ' likes' : ' dislike') .' your feedback.';
        $url  = '/feedback/'.$feedback_details->id;
        $this->notify_user($feedback_details->user_id, $url, $notification_msg);
        
        return redirect()->back()->withSuccess('Vote Posted Successfully!');
      }
      catch (\Exception $e){
        DB::rollback();
        dd($e);
        return redirect()->back()->withError('Something went wrong!');
      }
    }
}
