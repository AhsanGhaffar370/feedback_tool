<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};
use Illuminate\Support\Facades\{DB, Hash, URL, Storage, Validator, Auth};

class AuthController extends Controller
{

  public function adminLogin() {
    if (Auth::check())
      return redirect()->route('home');
      
    return view('back.login');
  }
  public function login() {
    if (Auth::check())
      return redirect()->route('home');
      
    return view('front.login');
  }

  public function loginCheck(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'email' => "required",
        'password' => "required",
    ]);
    if ($validator->fails()) {
        return back()->withInput()->withErrors($validator->errors());
    }

    try{
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if(!Auth::attempt($credentials))
        {
          return back()->withInput()->withErrors(['Email or password is incorrect']);
        }
        
        if(Auth::user()->hasRole('admin')){
          return redirect()->route('admin.dashboard');
        }
        else if(Auth::user()->hasRole('user')){
            return redirect()->route('user.dashboard');
        }
        else {
          return redirect()->route('home');
        }
    }
    catch (\Exception $e){
        return redirect()->back()->withError('Something went wrong!');
    }
  }


  public function userRegister() {

    if (Auth::check())
      return redirect()->route('home');


    return view('front.user_register');
  }

  public function storeUserRegister(Request $request)
  {  
    $rules = ([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6',
    ]);
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return back()->withInput()->withErrors($validator->errors());
    } 

    try {
      DB::beginTransaction();
      
      $data = $request->all();
      $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
      ]);

      
      $userRole = config('roles.models.role')::where('name', '=', "User")->first();
      $user->attachRole($userRole);

      DB::commit();
        
      return redirect("login")->withSuccess('Great! You have Successfully registered');
    } 
    catch (\Exception $e) {
        DB::rollback();
        dd($e);
        return back()->withError('Error! Something went wrong');
    }
  }
    
  public function userDashboard() {
    $user_id = auth()->id();
    $is_dashboard = true;
    $user_details = User::with(['feedbacks'])->find(Auth::id());


      return view('front.user.account_details', compact('user_details'));
    }
    
  public function accountDetails() {
    $is_dashboard = false;
    $user_details = User::with(['feedbacks'])->find(Auth::id());

    return view('front.user.account_details', compact('user_details'));
  }
  
  public function editPassword() {
    return view('front.user.edit_password');
  }


  public function adminAccountDetails() {
    
    $user_details = User::find(Auth::id());

    return view('back.account_details', compact('user_details'));
  }
  
}
