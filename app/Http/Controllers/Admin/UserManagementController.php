<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Session,DB, Hash,URL,Storage,Validator,Auth};
use App\Models\{
  User,
};

class UserManagementController extends Controller
{
    
  public function index() {

    $users = User::paginate(30);
    return view('back.user.user_list', compact('users'));
  }


}
