<?php

namespace App\Http\Controllers\Question;

use App\Models\Subject;
use Illuminate\Support\Str;
use Mockery\Matcher\Subset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SubjectRequest;
use RealRashid\SweetAlert\Facades\Alert;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('subject.index')){
            $subject=Subject::with('user')->latest()->get();
            return view('subject.index',compact('subject'));
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
        
        if(Gate::allows('subject.create')){
            return view('subject.form');
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
    public function store(SubjectRequest  $request)
    {
        $r=Subject::create([
            'title' =>$request->title,
            'slug'=>Str::slug($request->title),
            'description' =>strip_tags($request->description),
            'user_id'=>Auth::user()->id,
        ]);
        Toastr::success('Module Create successfully!','Success');
        return redirect()->route('subject.index');
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
        if(Gate::allows('subject.edit')){
            $subject=Subject::find($id);
            return view('subject.edit',compact('subject'));
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
    public function update(SubjectRequest  $request, $id)
    {
        $subject=Subject::find($id);
        $subject=DB::table('subjects')
            ->where('id', $subject->id)
            ->update([
            'title' => $request->title,
            'slug'=>Str::slug($request->title),
            'description' =>strip_tags($request->description),
            'user_id'=>Auth::user()->id,
            ]);
        Toastr::success('Subject Updated successfully!','Success');
        return redirect()->route('subject.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('subject.destroy')){
            $subject=Subject::find($id);
            $subject->delete();
            Toastr::success('Subject Delete successfully!','Success');
            return back();
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
