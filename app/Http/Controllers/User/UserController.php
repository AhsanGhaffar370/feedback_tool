<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Session, Hash,URL,Storage,Validator,Auth};
use Carbon\Carbon;
use App\Models\{
  CarDetail,
  Product,
  UserPost,
  User,
  ServiceType,
  UserPostRequest,
  Message,
  Country,
  State,
  Category,
  UserPostReview,
  MechanicVehicle,
  Notification,
};
use Pusher\Pusher;
use App\Events\NewMessage;
use App\Traits\{UploadTrait,CompanySettingsTrait,NotificationTrait};

class UserController extends Controller
{
  use UploadTrait,CompanySettingsTrait,NotificationTrait;
  
  public function postShow($id) {
    $user_post = UserPost::with(['serviceType', 'images'])->findOrFail($id);
    $post_request = UserPostRequest::where('user_post_id', $id)->where('mechanic_id', Auth::id())->first();

    return view('front.post_show', compact('user_post','post_request'));
  }

  public function postList($type, Request $request) {
    try { 
      
      $service_type_id  = null;
      if ($type == 'collision-repair')
        $service_type_id  = 2;
      if ($type == 'auto-mechanic')
        $service_type_id  = 1;
        
      $user_posts = UserPost::with(['serviceType'])->where('user_posts.service_type_id',$service_type_id);
      
      if (Auth::check()) {
        $user = Auth::user();
        $user_posts = $user_posts->Join('users', function($query) use($user) {
          $query->on('users.id', '=', 'user_posts.user_id')
          // ->where('users.zipcode', $user->zipcode)
          ;
        });
      }
      
      if ($request->has('make') && $request->has('model') && $request->has('year')) {
        $user = Auth::user();
        $user_posts = $user_posts->where('user_posts.make', $request->get('make'))
                                  ->where('user_posts.model', $request->get('model'))
                                  ->where('user_posts.year', $request->get('year'));
      }
      $user_posts = $user_posts->select('user_posts.*')
      ->orderBy('user_posts.created_at', 'DESC')
      ->where('user_posts.approval_status_id', 1)
      ->where('user_posts.post_status_id', 1)
      ->paginate(18);
      
      $makes = CarDetail::select('make')->groupBy('make')->get();
      
      $service_types = ServiceType::where('for_mechanic', 1)->get();

      return view('front.post_list', compact('user_posts', 'makes', 'service_types', 'service_type_id'));
    }
    catch (\Exception $e) {
      return redirect()->back()->withError('something went wrong');
    }
  }

  public function postListAjax(Request $request) {
    try {
      $user_posts = UserPost::with(['serviceType']);

      if (Auth::check()) {
        $user = Auth::user();
        $user_posts = $user_posts->Join('users', function($query) use($user) {
          $query->on('users.id', '=', 'user_posts.user_id')
          // ->where('users.zipcode', $user->zipcode)
          ;
        });
      }

      $user_posts = $user_posts->where('user_posts.approval_status_id', 1)
                                ->where('user_posts.post_status_id', 1)
                                ->select('user_posts.*')
                                ->orderBy('user_posts.created_at', 'DESC');

      $view = '';
      if ($request->has('service_type_id') && $request->get('service_type_id') != ''){
        $user_posts = $user_posts->where('user_posts.service_type_id', $request->get('service_type_id'));
      }
      if ($request->has('make') && $request->get('make') != ''){
        $user_posts = $user_posts->where('user_posts.make', $request->get('make'));
      }
      if ($request->has('model') && $request->get('model') != ''){
        $user_posts = $user_posts->where('user_posts.model', $request->get('model'));
      }
      if ($request->has('year') && $request->get('year') != ''){
        $user_posts = $user_posts->where('user_posts.year', $request->get('year'));
      }
      if ($request->has('title') && $request->get('title') != '' && strlen($request->get('title')) >= 3 ){
        $title = $request->get('title');
        $user_posts = $user_posts->where('user_posts.title','LIKE', "%$title%");
      }
      $user_posts = $user_posts->paginate(18);

      $view = view('front.post_list_ajax', ['user_posts' => $user_posts])->render();

      return response()->json(['code' => 200, 'view' => $view, 'message' => 'success']);
    }
    catch (\Exception $e) {
      // dd($e);
      return response()->json(['code' => 400, 'message' => 'something went wrong']);
    }
  }
  
  
}
