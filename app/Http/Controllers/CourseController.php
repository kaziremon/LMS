<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CoursePostRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CourseUpdateRequest;
class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('course.index')) {
            $courses = Course::with('user')->get();
            return view('course.index',compact('courses'));
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
        if (Gate::allows('course.create')) {
            $courses=Course::all();
            return view('course.form',compact('courses'));
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
    public function store(CoursePostRequest $request)
    {
    
        $course = Course::create([
            'title'=>$request->title,
            'user_id'=>Auth::user()->id,
        ]);

        Toastr::success('Created successfully!','success');
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        if (Gate::allows('course.edit')) {
            $courses=Course::all();
            return view('course.form',compact('course','courses'));
            }
        else{
            Alert::error('Do Not Give You Permission!', 'error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update([
            'title'=>$request->title,
            'user_id'=>Auth::user()->id,
        ]);
        Toastr::success('Updated successfully!','success');
        return redirect()->route('course.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if (Gate::allows('course.destroy')) {
            $course->delete();
            Toastr::success('Course Deleted Successfully!','success');
            return back();
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
