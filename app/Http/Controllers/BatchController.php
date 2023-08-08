<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BatchPostRequest;
use RealRashid\SweetAlert\Facades\Alert;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('batch.index')) {
            $batchs=Batch::with('course','user')->get();
            return view('batch.index',compact('batchs'));
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
        if (Gate::allows('batch.create')) {
            $courses=Course::all();
            return view('batch.form',compact('courses'));
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
    public function store(BatchPostRequest $request)
    {
        Batch::create([
            'course_id' =>$request->course_id,
            'user_id' =>Auth::user()->id,
            'name' =>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        Toastr::success('Batch Created successfully!', 'Success');
        return redirect()->route('batch.index');//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function show(Batch $batch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function edit(Batch $batch)
    {
        if (Gate::allows('batch.edit')) {
            $courses=Course::all();
            return view('batch.form', compact('batch','courses'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batch $batch)
    {
        $batch->update([
            'course_id' =>$request->course_id,
            'user_id' =>Auth::user()->id,
            'name' =>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        Toastr::success('Batch Updated successfully!', 'Success');
        return redirect()->route('batch.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batch  $batch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batch $batch)
    {
        if (Gate::allows('batch.destroy')) {
            $batch->delete();
            Toastr::success('Deleted Successfully!','success');
            return back();
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
