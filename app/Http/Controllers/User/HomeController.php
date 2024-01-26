<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB,Session, Hash,URL,Storage,Validator,Auth};
use Carbon\Carbon;
use App\Models\{
  User,
  Feedback
};

class HomeController extends Controller
{

  public function index() {

    $feedbacks = Feedback::paginate(4);
      
    return view('front.feedback.index', compact('feedbacks'));
  }

}