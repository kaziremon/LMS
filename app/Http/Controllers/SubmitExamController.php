<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SubmitExam;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use App\Models\SubmitExamDetail;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SubmitExamController extends Controller
{
    public function index($id)
    {
        $info=ExamQuestion::with('exam','setquestion','subject','chapter')->where('exam_id',$id)->first();
        $questions=ExamQuestion::with('exam','setquestion','subject','chapter')
                                ->where('exam_id',$id)
                                ->where('status',1)
                                ->get();
        $date=Carbon::now();
        $time=$date->format('h:i A');
        return view('submitexam.exam',compact('questions','info','time'));
    }

    public function store(Request $request)
    {

        $exam['exam_id']=$request->exam_id;
        $exam['user_id']=Auth::user()->id;
        $examsubmit= SubmitExam::create($exam);
        $test=$examsubmit->id;
        $question=$request->question;
            foreach($question as $key => $no)
            {
                $input['submitexam_id']= $test;
                $input['setquestion_id'] = $question[$key];

                $radio_value='radio_'.$request->question[$key];
                $radio=$request->$radio_value;
                $answer=$request->answer;
                $have_ansqwer=QuestionAnswer::where('setquestion_id',$question[$key])->first();
                if(isset($have_ansqwer)){
                    $input['answer']=$radio;
                    if($have_ansqwer->answer==$radio){
                        $mark=ExamQuestion::where('setquestion_id',$question[$key])->first();
                        $input['mark']=$mark->mark;
                    }else{
                        $input['mark']='0';
                    }
                }else{
                    $input['answer']=$answer[$key] ?? '';
                    $input['mark']='0';
                }
            $examsubmit= SubmitExamDetail::create($input);
        }
            Alert::success('Exam Submitted successfully!', 'Success');
            return redirect()->route('home');
     }

     public function auto_submit(Request $request)
     {


        $exam['exam_id']=$request->exam_id;
        $exam['user_id']=Auth::user()->id;
        $examsubmit= SubmitExam::create($exam);
        $test=$examsubmit->id;
        $question=$request->question;
            foreach($question as $key => $no)
            {
                $input['submitexam_id']= $test;
                $input['setquestion_id'] = $question[$key];

                $radio_value='radio_'.$request->question[$key];
                $radio=$request->$radio_value;
                $answer=$request->answer;
                $have_ansqwer=QuestionAnswer::where('setquestion_id',$question[$key])->first();
                if(isset($have_ansqwer)){
                    $input['answer']=$radio;
                    if($have_ansqwer->answer==$radio){
                        $mark=ExamQuestion::where('setquestion_id',$question[$key])->first();
                        $input['mark']=$mark->mark;
                    }else{
                        $input['mark']='0';
                    }
                }else{
                    $input['answer']=$answer[$key] ?? '';
                    $input['mark']='0';
                }
            $examsubmit= SubmitExamDetail::create($input);
        }
            Alert::success('Exam Submitted successfully!', 'Success');

         return response()->json(
             [
                 'success' => true,
                 'message' => 'Exam Submit Successfully!',
                 'url'=>url('/exam/list')
             ]
         );

     }

}
