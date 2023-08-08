<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\SubmitExam;
use App\Models\Trainee;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // public function index()
    // {
    //     return view('home');
    // }

    
    public function index()
    {

       
        $data=[];
        $batch_under=User::where('batch_id',Auth::user()->batch_id)->count();
        $data['total_student_under']=$batch_under-1;
        $data['teacher']=User::where('role_id',3)->count();
        $data['student']=User::where('role_id',4)->count();
        $data['batch']=Batch::count();
        $data['course']=Course::count();
        $data['users']=User::count();
        $data['exams']=Exam::with('course','user','batch')
                            ->where('batch_id',Auth::user()->batch_id)
                            ->get();
        $exam_count=Exam::with('course','user','batch')
                            ->where('batch_id',Auth::user()->batch_id)
                            ->count();
        $submitexam=DB::table('submit_exams')
                            ->where('user_id',Auth::user()->id)
                            ->count();
        $data['teacher_exam']=DB::table('exams')
        ->where('user_id',Auth::user()->id)
        ->count();
        $data['show_exam']=$exam_count-$submitexam;
        $date=Carbon::now();
        $data['formate_date']=date('Y-m-d', strtotime($date));
        $data['time']=$date->format('g:i A');
        if(Auth::user()->role_id=='4'){
            return view('student',$data);
        }elseif(Auth::user()->role_id=='3'){
            return view('teacher',$data);
        }else{
            return view('home',$data);
        }
    }

    public function exam_list()
    {
        $data=[];
        $data['batch']=Batch::count();
        $data['users']=User::count();
        $data['exams']=Exam::with('course','user','batch')
                            ->where('batch_id',Auth::user()->batch_id)
                            ->where('status',1)
                            ->latest()->get();
        $data['submit_exam']=SubmitExam::with('exam')
                    ->where('user_id',Auth::user()->id)
                    ->get();
        $date=Carbon::now();
        $data['formate_date']=date('Y-m-d', strtotime($date));
        $data['time']=$date->format('h:i A');
        return view('exam_list',$data);

    }
}
