<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Batch;
use App\Models\Course;
use App\Models\MarkInfo;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class MarksheetController extends Controller
{
    public function index()
    {
        if(Gate::allows('markinfo.index')) {
            $marks = DB::table('mark_infos')
                ->join('courses', 'courses.id', '=', 'mark_infos.course_id')
                ->join('batches', 'batches.id', '=', 'mark_infos.batch_id')
                ->join('exams', 'exams.id', '=', 'mark_infos.exam_id')
                ->select('courses.title', 'batches.name as batch_name', 'exams.exam_title', 'mark_infos.total_mark','mark_infos.obtained_mark','exams.mark_publish')
                ->where('mark_infos.user_id', '=', Auth::user()->id)
                ->get();

            return view('markinfo.index',compact('marks'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function teacher_mark(){
        if(Gate::allows('teacher.markinfo')) {
            $batches=Batch::all();
            $courses=Course::all();
            return view('markinfo.markinfo',compact('batches','courses'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function get_usermark(Request $request,$course_id,$batch_id,$user_id)
    {
        $data = DB::table('mark_infos')
                ->join('courses', 'courses.id', '=', 'mark_infos.course_id')
                ->join('batches', 'batches.id', '=', 'mark_infos.batch_id')
                ->join('exams', 'exams.id', '=', 'mark_infos.exam_id')
                ->select('courses.title', 'batches.name as batch_name', 'exams.exam_title','exams.user_id', 'mark_infos.total_mark','mark_infos.obtained_mark','exams.mark_publish')
                ->where('mark_infos.user_id', '=', $user_id)
                ->where('mark_infos.course_id', '=', $course_id)
                ->where('mark_infos.batch_id', '=', $batch_id)
                ->get();
        if ($request->ajax()) {
            return view('markinfo.table', compact('data'));
        }
        return view('markinfo.markinfo', compact('data'));
    }
}
