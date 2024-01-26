<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Session, Hash,URL,Storage,Validator,Auth};
use Carbon\Carbon;
use App\Models\{
  Feedback,
  Category
};

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $feedbacks = Feedback::where('user_id', Auth::id())->paginate(4);
     
      return view('front.user.feedback.index', compact('feedbacks'));
    }

    public function list()
    {
      $feedbacks = Feedback::paginate(4);
      
      return view('front.feedback.index', compact('feedbacks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      return view('front.user.feedback.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'title' => "required",
        'description' => "required",
        'category_id' => "required",
      ]);
      if ($validator->fails()) {
        return back()->withInput()->withErrors($validator->errors());
      }

      try{
        DB::beginTransaction();

        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['status_id'] = 1;

        $feedback = Feedback::create($input);

        DB::commit();

        return redirect()->route('user.feedback.index')->withSuccess('Feedback Created Successfully!');
      }
      catch (\Exception $e){
        DB::rollback();
        dd($e);
        return redirect()->back()->withError('Something went wrong!');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $feedback = Feedback::findOrFail($id);
  
      return view('front.user.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $feedback = Feedback::findOrFail($id);
      $categories = Category::all();
  
      return view('front.user.feedback.edit', compact('feedback', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'title' => "required",
        'description' => "required",
        'category_id' => "required",
      ]);
      if ($validator->fails()) {
        return back()->withInput()->withErrors($validator->errors());
      }

      try{
        DB::beginTransaction();

        $input = $request->all();

        $feedback = Feedback::where('user_id', Auth::id())->where('id',$id);

        $feedback->update($input);

        DB::commit();

        return redirect()->route('user.feedback.index')->withSuccess('Feedback Updated Successfully!');
      }
      catch (\Exception $e){
        DB::rollback();
        dd($e);
        return redirect()->back()->withError('Something went wrong!');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        DB::beginTransaction();
  
        $feedback = Feedback::where('user_id', Auth::id())->where('id',$id);

        $feedback->delete();
  
        DB::commit();
        
        return redirect()->route('user.feedback.index')->withSuccess('Feedback Deleted Successfully!');
      }
      catch(\Exception $e) {
        DB::rollback();
        dd($e);
        return redirect()->back()->withError('Something went wrong!');
      }
    }

    
  public function feedbackUpdateStatus(Request $request, $id)
  {
      try{
          $feedback=Feedback::find($id);
          $feedback->status_id = $request->status_id;
          $feedback->save();

          return response()->json(['code' => '200', 'message'=> 'Status update successfully!']);
      }
      catch (\Exception $e){
          return response()->json(['code' => '500','message'=> 'Something went wrong!']);
      }
  }
}
