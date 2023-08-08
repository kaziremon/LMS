<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\MarkInfo;
use App\Models\SubmitExam;
use Illuminate\Http\Request;
use App\Models\SubmitExamDetail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class EvaluationController extends Controller
{
    public function index()
    {
       if(Gate::allows('exam.evaluation')) {
           if(Auth::user()->role_id==1 || Auth::user()->role_id==2){
               $exams=Exam::with('course','batch','user')->latest()->get();
               return view('evaluation.index',compact('exams'));
           }else{
               $user_id=Auth::user()->id;
               $exams=Exam::with('course','batch','user')->where('user_id','=',$user_id)->latest()->get();
               return view('evaluation.index',compact('exams'));
           }
       }else{
           Alert::error('Do Not Give You Permission!', 'error');
           return back();
       }
    }

    public function list($id)
    {
       if(Gate::allows('exam.evaluation_list')) {
           $exam=Exam::find($id);
           $examsubmit=SubmitExam::with('user','exam')
                                   ->where('exam_id',$id)
                                   ->get();
           return view('evaluation.list',compact('examsubmit','exam'));
       }else{
           Alert::error('Do Not Give You Permission!', 'error');
           return back();
       }
    }

    public function view($id)
    {
       if(Gate::allows('exam.evulation_mark')) {
           $examsubmitdetails=SubmitExamDetail::with('setquestion','submitexam')
                                       ->where('submitexam_id',$id)
                                       ->paginate(10);
           $examsubmit=SubmitExam::with('exam','user')
                               ->where('id',$id)
                               ->first();
           $info=Exam::with('examsubmit','user','course','batch')->where('id',$examsubmit->exam_id)->first();

           return view('evaluation.view',compact('examsubmitdetails','examsubmit','info'));
       }else{
           Alert::error('Do Not Give You Permission!', 'error');
           return back();
       }
    }
    public function mark($id)
    {
       if(Gate::allows('evaluation.view')) {
           $examsubmitdetails=SubmitExamDetail::with('setquestion','submitexam')
                                       ->where('submitexam_id',$id)
                                       ->get();
           $examsubmit=SubmitExam::with('exam','user')
                               ->where('id',$id)
                               ->first();
           $info=Exam::with('examsubmit','user','course','batch')->where('id',$examsubmit->exam_id)->first();

           return view('evaluation.mark',compact('examsubmitdetails','examsubmit','info'));
       }else{
           Alert::error('Do Not Give You Permission!', 'error');
           return back();
       }
    }

    public function mark_store(Request $request)
    {
       $id=$request->id;
       $mark=$request->mark;
       foreach($id as $key => $no)
       {
           $up = SubmitExamDetail::where('id',$id[$key])->update(['mark'=>$mark[$key]]);
       }
     $markinfo=MarkInfo::where('exam_id',$request->exam_id)->where('user_id',$request->user_id)->first();
     $exam=Exam::where('id',$request->exam_id)->first();

       if(empty($markinfo))
       {
           $obtained_mark=0;
           foreach($id as $key => $no)
           {
               $obtained_mark+=$mark[$key];
           }
          $createmarkinfo=MarkInfo::create([
              'user_id'=>$request->user_id,
              'exam_id'=>$request->exam_id,
              'obtained_mark'=>$obtained_mark,
              'total_mark'=>$request->total_mark,
              'course_id'=>$exam->course_id,
              'batch_id'=>$exam->batch_id,
          ]);
       }else{
           $obtained_mark=0;
           foreach($id as $key => $no)
           {
               $obtained_mark+=$mark[$key];
           }
           $updatemarkinfo=MarkInfo::where('exam_id',$request->exam_id)
                                   ->where('user_id',$request->user_id)
                                   ->update([
                                       'obtained_mark'=>$obtained_mark,
                                       'total_mark'=>$request->total_mark
                                   ]);
       }
       Toastr::success('Exam Mark Updated successfully!', 'Success');
       return back();
   }

}
