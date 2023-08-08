<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Exam;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\SetQuestion;
use Mockery\Matcher\Subset;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class ExamController extends Controller
{
    public function index()
    {
        if(Gate::allows('exam.index')) {
            if(Auth::user()->role_id==1 || Auth::user()->role_id==2){
                $exams=Exam::with('course','batch','user')->latest()->get();
                return view('exam.index',compact('exams'));
            }else{
                $user_id=Auth::user()->id;
                $exams=Exam::with('course','batch','user')->where('user_id','=',$user_id)->latest()->get();
                return view('exam.index',compact('exams'));
            }
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function create()
    {
        if(Gate::allows('exam.create')) {
            $batches=Batch::all();
            $courses=Course::all();
            return view('exam.form',compact('batches','courses'));
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'exam_title'=>'required|string',
            'course_id' =>'required',
            'batch_id' =>'required',
            'start_time' =>'required',
            'end_time' =>'required |after:start_time',
            'date'=>'required|date',
        ]);

        $exam=Exam::create([
            'exam_title' =>$request->exam_title,
            'course_id' =>$request->course_id,
            'batch_id'=>$request->batch_id,
            'start_time'=>date('h:i A', strtotime($request->start_time)),
            'end_time'=>date('h:i A', strtotime($request->end_time)),
            'date'=>date('Y-m-d', strtotime($request->date)),
            'user_id'=>Auth::user()->id,
            'status'=>0,
        ]);
        Toastr::success('Exam Created successfully!', 'Success');
        return redirect()->route('exam.index');
    }

    public function edit($id)
    {
        if(Gate::allows('exam.edit')) {
            $exam=Exam::with('course','batch','user')->where('id',$id)->first();
            $batches=Batch::all();
            $courses=Course::all();
            return view('exam.edit',compact('exam','batches','courses'));
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'exam_title'=>'required|string',
            'course_id' =>'required',
            'batch_id' =>'required',
            'date'=>'required|date',
            'start_time' =>'nullable',
            'end_time' =>'nullable |after:start_time',
        ]);

        $exam=Exam::find($id);
        $exam->update([
        'exam_title' =>$request->exam_title,
        'course_id' =>$request->course_id,
        'batch_id'=>$request->batch_id,
        'start_time'=>isset($request->start_time) ? date('h:i A', strtotime($request->start_time)) : $exam->start_time,
        'end_time'=>isset($request->end_time) ? date('h:i A', strtotime($request->end_time)) : $exam->end_time,
        'date'=>date('Y-m-d', strtotime($request->date)) ?? $exam->date,
        'user_id'=>$exam->user_id ?? Auth::user()->id,
    ]);
    Toastr::success('Exam Updated successfully!', 'Success');
    return redirect()->route('exam.index');
    }

    public function destroy($id)
    {
        if(Gate::allows('exam.destroy')) {
            $exam=Exam::find($id);
            $exam->delete();
            Alert::success('Exam Delete successfully!', 'Success');
            return back();
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function exam_question($id)
    {
        if(Gate::allows('exam.setquestion')) {
            $exam=Exam::find($id);
            $subject=Subject::all();
            $chapter=Chapter::all();
            return view('exam.exam_question',compact('exam','subject','chapter'));
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function exam_chapter_question(Request $request)
    {
        $chapter_id=$request->chapter_id;
        $subject_id=$request->subject_id;
        $defficult_level=$request->defficult_level;
        $question=$request->question;
        if(empty($chapter_id) && empty($subject_id) && empty($defficult_level)){
            $data=SetQuestion::where('question', 'like', "%{$question}%")
                            ->where('status',1)
                            ->get();
        }else if(empty($chapter_id) && empty($subject_id) && empty($question)){
            $data=SetQuestion::where('defficult_level',$defficult_level)
                                ->where('status',1)
                                ->get();
        }else if(empty($defficult_level) && empty($subject_id) && empty($question)){
            $data=SetQuestion::where('chapter_id',$chapter_id)
                                ->where('status',1)
                                ->get();
        }else if(empty($defficult_level) && empty($chapter_id) && empty($question)){
            $data=SetQuestion::where('subject_id',$subject_id)
                            ->where('status',1)
                            ->get();
        }else if(empty($subject_id) && empty($chapter_id)){
            $data=SetQuestion::where('question', 'like', "%{$question}%")
                             ->where('defficult_level',$defficult_level)
                             ->where('status',1)
                             ->get();
        }else if(empty($subject_id) && empty($defficult_level)){
            $data=SetQuestion::where('question', 'like', "%{$question}%")
                             ->where('chapter_id',$chapter_id)
                             ->where('status',1)
                             ->get();
        }else if(empty($subject_id) && empty($question)){
            $data=SetQuestion::where('defficult_level',"$defficult_level")
                             ->where('chapter_id',$chapter_id)
                             ->where('status',1)
                             ->get();
        }else if(empty($chapter_id) && empty($defficult_level)){
            $data=SetQuestion::where('question', 'like', "%{$question}%")
                             ->where('subject_id',$subject_id)
                             ->where('status',1)
                             ->get();
        }else if(empty($chapter_id) && empty($question)){
            $data=SetQuestion::where('defficult_level',"$defficult_level")
                             ->where('subject_id',$subject_id)
                             ->where('status',1)
                             ->get();
        }else if(empty($defficult_level) && empty($question)){
            $data=SetQuestion::where('chapter_id',"$chapter_id")
                             ->where('subject_id',$subject_id)
                             ->where('status',1)
                             ->get();
        }else if(empty($subject_id)){
            $data=SetQuestion::where('chapter_id',"$chapter_id")
                             ->where('question', 'like', "%{$question}%")
                             ->where('defficult_level',"$defficult_level")
                             ->where('status',1)
                             ->get();
        }else if(empty($chapter_id)){
            $data=SetQuestion::where('subject_id',"$subject_id")
                             ->where('question', 'like', "%{$question}%")
                             ->where('defficult_level',"$defficult_level")
                             ->where('status',1)
                             ->get();
        }else if(empty($defficult_level)){
            $data=SetQuestion::where('subject_id',"$subject_id")
                             ->where('question', 'like', "%{$question}%")
                             ->where('chapter_id',"$chapter_id")
                             ->where('status',1)
                             ->get();
        }else if(empty($question)){
            $data=SetQuestion::where('subject_id',"$subject_id")
                             ->where('defficult_level',"$defficult_level")
                             ->where('chapter_id',"$chapter_id")
                             ->where('status',1)
                             ->get();
        }else{
            $data=SetQuestion::where('subject_id',"$subject_id")
                             ->where('defficult_level',"$defficult_level")
                             ->where('chapter_id',"$chapter_id")
                             ->where('question', 'like', "%{$question}%")
                             ->where('status',1)
                             ->get();
        }
        $quesion_id =SetQuestion::with('question')
                    ->where("subject_id",$subject_id)
                    ->where('chapter_id',$chapter_id)
                    ->first();
        if ($request->ajax()) {
            return view('exam.question_partisal', compact('data','quesion_id'));
        }
        return view('exam.exam_question', compact('data','quesion_id'));
    }

    public function question_insert(Request $request)
    {
           $question=$request->setquestion_id;
           foreach($question as $key=>$value){
            $getmark='mark_'.$question[$key];
            $setmark=$request->$getmark;
            $check=ExamQuestion::where('exam_id',$request->exam_id)
                                ->where('setquestion_id',$question[$key])->first();
            $chapter_id=Chapter::where('subject_id',$request->subject_id)->first();
            if(!isset($check)){
            $examquestion=DB::table('exam_questions')->insert([
                'exam_id' => $request->exam_id,
                'subject_id' => $request->subject_id,
                'chapter_id' => $request->chapter_id ?? $chapter_id->id,
                'setquestion_id' => $question[$key],
                'mark'=>$setmark,
                'status' => '0'
            ]);
        }else{
            $examquestion=DB::table('exam_questions')
                            ->where('id',$check->id)
                            ->update([
                                'exam_id' => $request->exam_id,
                                'subject_id' => $request->subject_id,
                                'chapter_id' => $request->chapter_id ??$chapter_id->id,
                                'setquestion_id' => $question[$key],
                                'mark'=>$setmark,
                                'status' => '0'
                            ]);
        }

        }
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Exam Question Set!'
                ]
            );

            return back();
    }


    public function question_privew($exam_id)
    {
        if(Gate::allows('exam.preview')) {
            $examquestiondetails=ExamQuestion::with('exam','setquestion')->where('exam_id',$exam_id)->first();
            $examquestion=ExamQuestion::with('exam','setquestion')->where('exam_id',$exam_id)->get();
            return view('exam.preview',compact('examquestion','examquestiondetails'));
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function question_privew_delete($id)
    {
        if(Gate::allows('exam.preview_questiondelete')) {
            $data =DB::table("exam_questions")
            ->where('id',$id)->delete();
            return response()->json([
                'data'=>$data,
                'success' => 'Question deleted successfully!'
            ]);
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function question_privew_update(Request $request)
    {
        $id=$request->id;
        foreach($id as $key=>$value){
         $exam_questions= DB::table('exam_questions')
         ->where('id',$id[$key])
         ->update(['status' =>'1']);
         }

         return response()->json([
            'data'=>$exam_questions,
            'success' => 'Question Status Updated successfully!',
            'url'=>url('/exam')
        ]);
    }

    public function status($id)
    {
        if(Gate::allows('exam.status')) {
            $find=Exam::find($id);
            if($find->status==1){
                $find->update([
                    'status'=>0,
                ]);
            }else{
                $find->update([
                    'status'=>1,
                ]);
                $user_info=[
                    'exam_title' => $find->exam_title,
                    'date' => $find->date,
                    'start_time' => $find->start_time,
                    'end_time' => $find->end_time,
                ];
                // $exam_info='Title:'.$find->exam_title.', Date:'. $find->date.', Start Time:'.$find->start_time.', End Time:'.$find->end_time.'';
                // $getusers=User::where('batch_id',$find->batch_id)->get();
                // foreach($getusers as $user){
                //     $user->notify(new AssignAssignmentNotification($user, $exam_info));

                //    Mail::to($use->email)->send(new ExamMail($user_info));
                //  }
                //  foreach ($getusers as $key => $no) {
                //      $user = User::find($no);
                //      $user->notify(new AssignAssignmentNotification($user, $user_info));
                //  }
            }
            Toastr::success('Exam published successfully!', 'Success');
            return back();
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function mark_publish($id)
    {
        if(Gate::allows('exam.mark_publish')) {
            $find=Exam::find($id);
            if($find->mark_publish==1){
                $find->update([
                    'mark_publish'=>0,
                ]);
            }else{
                $find->update([
                    'mark_publish'=>1,
                ]);
            }
            Toastr::success('Exam  Mark publish successfully!', 'Success');
            return back();
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
