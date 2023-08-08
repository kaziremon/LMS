<?php

namespace App\Http\Controllers\Question;
use DB;
use App\Models\Chapter;
use App\Models\Subject;
use App\Models\SetQuestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class QuestionReviewController extends Controller
{
    public function rivew_index()
    {
        if(Gate::allows('review.index')){
            $subject=Subject::all();
            $chapter=Chapter::all();
            return view('rivew.index',compact('subject','chapter'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function get_question(Request $request,$subject_id,$chapter_id)
    {
        $data = DB::table("set_questions")
            ->where("subject_id",$subject_id)
            ->where('chapter_id',$chapter_id)
            ->where('status',0)
            ->get();
        if ($request->ajax()) {
            return view('rivew.view', compact('data'));
        }
        return view('rivew.index', compact('data'));
    }
    public function edit(Request $request,$id)
    {
        if(Gate::allows('review.edit')){
            $quest=SetQuestion::where('id',$id)->first();
            if ($request->ajax()) {
                return view('rivew.modal', compact('quest'));
            }
            return view('rivew.index', compact('quest'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function single_status_update($id)
    {
        if(Gate::allows('review.status')){
            $update=DB::table('set_questions')
                        ->where('id',$id)
                        ->update([
                            'status' =>'1',
                            'draft'=>'0'
                        ]);
            return response()->json([
                'data'=>$update,
                'success'=>'Question Saved To Question Bank Successfully!'
            ]);
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function delete($id)
    {
        if(Gate::allows('review.destroy')){
            $data =DB::table("set_questions")
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
    public function update(Request $request,$id)
    {


        $question=DB::table("set_questions")
                    ->where('id',$id)
                    ->update([
                        'question' => $request->question,
                        'mark'=>$request->mark,
                        'defficult_level'=>$request->defficult_level,
                        'rubric'=>$request->rubric,
                    ]);
        if($request->answer){
            $answer= DB::table('question_answers')
            ->where('setquestion_id',$id)
            ->update(['answer' => $request->answer]);

            $option=$request->option;
            foreach($option as $key=>$value)
            {
                $set_name=$request->option[$key];
                $get_value=$request->$set_name;
                $option_table=DB::table('question_mcqs')
                                ->where('id',$set_name)
                                ->update([
                                    'option'=>$get_value
                                ]);
            }
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Question Update Successfully!'
            ]
        );


    }
    public function question_bank()
    {
        $subject=Subject::all();
        $chapter=Chapter::all();
        return view('rivew.questionbank',compact('subject','chapter'));
    }
    public function get_chapter_question(Request $request,$subject_id,$chapter_id)
    {
        $data = DB::table("set_questions")
                ->where("subject_id",$subject_id)
                ->where('chapter_id',$chapter_id)
                ->get();
        $quesion_id = DB::table("set_questions")
        ->where("subject_id",$subject_id)
        ->where('chapter_id',$chapter_id)
        ->first();
        if ($request->ajax()) {
            return view('rivew.status', compact('data','quesion_id'));
        }
        return view('rivew.questionbank', compact('data','quesion_id'));
    }
    public function status_update(Request $request)
    {
       $status=$request->status;
       if($status){
       foreach($status as $key=>$value){
        $wquestion= DB::table('set_questions')
        ->where('question_id',$request->question_id)
        ->where('id','!=',$status[$key])
        ->update([
            'status' =>'0',
            'draft'=>'1'
           ]);
        }
        foreach($status as $key=>$value){
             $question= DB::table('set_questions')
             ->where('question_id',$request->question_id)
             ->where('id',$status[$key])
             ->update([
                 'status' =>'1',
                 'draft'=>'0'
                ]);
        }
    }else{
        $wquestion= DB::table('set_questions')
        ->where('question_id',$request->question_id)
        ->update([
            'status' =>'0',
            'draft'=>'1'
           ]);
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Question Saved To Question Bank Successfully!'
            ]
        );
    }

    public function admin_index()
    {
        if(Gate::allows('admin_review.index')){
            $subject=Subject::all();
            $chapter=Chapter::all();
            return view('rivew.admin_index',compact('subject','chapter'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function admin_get_question(Request $request,$subject_id,$chapter_id)
    {
        $data = DB::table("set_questions")
            ->where("subject_id",$subject_id)
            ->where('chapter_id',$chapter_id)
            ->where('status',1)
            ->get();
        if ($request->ajax()) {
            return view('rivew.admin_view', compact('data'));
        }
        return view('rivew.admin_index', compact('data'));
    }

}
