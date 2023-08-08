<?php

namespace App\Http\Controllers\Question;

use App\Models\Chapter;
use App\Models\Subject;
use App\Models\Question;
use App\Models\QuestionType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\QuestionRequest;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('question.index')){
            $question=Question::with('questiontype','user','chapter')->latest()->get();
            return view('question.index',compact('question'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('question.create')){
            $subject=Subject::all();
            $chapter=Chapter::all();
            $examtype=QuestionType::all();
            return view('question.create',compact('subject','chapter','examtype'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $question=Question::create([
            'questiontype_id' =>$request->questiontype_id,
            'chapter_id'=>$request->chapter_id,
            'user_id'=>Auth::user()->id,
            'is_bank'=>$request->is_bank ?? 0,
        ]);

        Toastr::success('Question Create successfully!','Success');
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::allows('question.edit')){
            $question=Question::with('chapter')->where('id',$id)->first();
            $subject=Subject::all();
            $chapter=Chapter::all();
            $examtype=QuestionType::all();
            return view('question.edit',compact('question','subject','chapter','examtype'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $question=Question::find($id);
        $question->update([
            'questiontype_id' =>$request->questiontype_id,
            'chapter_id'=>$request->chapter_id,
            'user_id'=>Auth::user()->id,
            'is_bank'=>$request->is_bank ?? 0,
        ]);
        Toastr::success('Question Update successfully!','Success');
        return redirect()->route('question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('question.destroy')){
            $question=Question::find($id);
            $question->delete();
            Toastr::success('Question Delete successfully!','Success');
            return back();
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function status($id)
    {
         if(Gate::allows('question.status')){
             $find=Question::find($id);
             if($find->is_bank==1){
                 $find->update([
                     'is_bank'=>0,
                 ]);
             }else{
                 $find->update([
                     'is_bank'=>1,
                 ]);
             }
             Toastr::success('Question Save To Question Bank Successfully!','Success');
             return back();
         }else{
             Toastr::error('Do Not Give You Permission!','error');
             return back();
         }
    }
}
