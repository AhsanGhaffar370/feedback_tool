<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Session, Hash,URL,Storage,Validator,Auth};
use App\Models\{
  Feedback,
  User,
  Status,
};

class AdminController extends Controller
{
  

  public function dashboard() {
    $feedbacks = Feedback::paginate(4);
    $statuses = Status::all();
    
    return view('back.feedback.index', compact('feedbacks', 'statuses'));
  }


}
