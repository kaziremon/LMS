<?php

namespace App\Http\Controllers\Question;

use App\Models\Chapter;
use App\Models\Subject;
use Mockery\Matcher\Subset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ChapterRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('chapter.index')){
            $chapter=Chapter::with('subject','user')->latest()->get();
            return view('chapter.index',\compact('chapter'));
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
        if(Gate::allows('chapter.create')){
            $subjects=Subject::all();
            return view('chapter.create',compact('subjects'));
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
    public function store(ChapterRequest $request)
    {

        Chapter::create([
            'name' =>$request->name,
            'learning_outcome'=>strip_tags($request->learning_outcome),
            'subject_id'=>$request->subject_id,
            'user_id'=>Auth::user()->id,
        ]);
        Toastr::success('Chapter Create successfully!','Success');
        return redirect()->route('chapter.index');
       
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
        if(Gate::allows('chapter.edit')){
            $chapter=Chapter::find($id);
            $subjects=Subject::all();
            return view('chapter.edit',compact('subjects','chapter'));
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
    public function update(ChapterRequest $request, $id)
    {
        $chapter=Chapter::find($id);
        $chapter->update([
            'name' =>$request->name,
            'learning_outcome'=>strip_tags($request->learning_outcome),
            'subject_id'=>$request->subject_id,
            'user_id'=>Auth::user()->id,
        ]);
        Toastr::success('Chapter Update successfully!','Success');
        return redirect()->route('chapter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('chapter.destroy')){
            $topictype=Chapter::find($id);
            $topictype->delete();
            Toastr::success('Chapter Delete successfully!','Success');
            return back();
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
