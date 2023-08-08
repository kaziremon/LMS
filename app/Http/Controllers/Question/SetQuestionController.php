<?php

namespace App\Http\Controllers\Question;

use DB;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\QuestionMcq;
use App\Models\SetQuestion;
use Illuminate\Http\Request;
use App\Models\QuestionAnswer;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class SetQuestionController extends Controller
{
    public function question_make($id)
   {

        if(Gate::allows('question.make')){
            $question=Question::with('questiontype','chapter','user')->where('id',$id)->first();
            if($question->questiontype_id==1){
                return view('question_make.question_written',\compact('question'));
            }else if($question->questiontype_id==2){
                return view('question_make.question_mcq',\compact('question'));
            }else{
                return view('question_make.question_combined',\compact('question'));
            }
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }

   }

   public function writen_store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'question' => 'required',
           'mark'=>'required',
           'defficult_level'=>'required',
       ]);

       if ($validator->fails()) {
           return redirect()->back()
                       ->withErrors($validator)
                       ->withInput();
       }

       try{
      $chapter=Question::where('id',$request->question_id)->select('chapter_id')->first();
      $subject=Chapter::where('id',$chapter->chapter_id)->select('subject_id')->first();
      $question_id=$request->question_id;
      $question= $request->question;
      $mark = $request->mark;
      $rubric=$request->rubric;
      $defficult_level=$request->defficult_level;
     foreach($question as $key => $no)
       {
       $input['question'] = strip_tags($question[$key]);
       $input['mark'] = $mark[$key];
       $input['rubric'] = strip_tags($rubric[$key]);
       $input['question_id']=$question_id;
       $input['chapter_id']=$chapter->chapter_id;
       $input['subject_id']=$subject->subject_id;
       $input['defficult_level']=$defficult_level[$key];
       $input['user_id']=Auth::user()->id;
       $input['draft']=1;
       $input['status']=0;
       $myquestion= SetQuestion::create($input);
       }

       Toastr::success('Set Off Question  Create successfully!','Success');
       return redirect()->route('question.index');
    }catch (\Exception $e) {
        Toastr::warning('Set Off Question Not Create!','warning');
        return back();
    }
   }
   public function mcq_store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'question' => 'required',
           'mark'=>'required',
           'defficult_level'=>'required',
       ]);

       if ($validator->fails()) {
           return redirect()->back()
                       ->withErrors($validator)
                       ->withInput();
       }
       try{
      $chapter=Question::where('id',$request->question_id)->select('chapter_id')->first();
      $subject=Chapter::where('id',$chapter->chapter_id)->select('subject_id')->first();
      $question = $request->question;
      $correct = $request->correct;
      $option1=$request->option1;
      $option2=$request->option2;
      $option3=$request->option3;
      $option4=$request->option4;
      $mark = $request->mark;
      $question_id=$request->question_id;
      $defficult_level=$request->defficult_level;
     foreach($question as $key =>$value)
       {
       $input['question'] = strip_tags($question[$key]);
       $input['mark'] = $mark[$key];
       $input['question_id']=$question_id;
       $input['chapter_id']=$chapter->chapter_id;
       $input['subject_id']=$subject->subject_id;
       $input['defficult_level']=$defficult_level[$key];
       $input['user_id']=Auth::user()->id;
       $input['draft']=1;
       $input['status']=0;
       $myquestion= SetQuestion::create($input);
           $firstoption=QuestionMcq::create([
           'setquestion_id' => $myquestion->id,
           'option'      => strip_tags($option1[$key]),
           ]);

           $secondoption=QuestionMcq::create([
               'setquestion_id' => $myquestion->id,
               'option'      => strip_tags($option2[$key]),
               ]);

            $thirdoption=QuestionMcq::create([
               'setquestion_id' => $myquestion->id,
               'option'      => strip_tags($option3[$key]),
               ]);

               $fouroption=QuestionMcq::create([
               'setquestion_id' => $myquestion->id,
               'option'      => strip_tags($option4[$key]),
               ]);
               if($correct[$key]=="option1"){
                  QuestionAnswer::create([
                       'setquestion_id' => $myquestion->id,
                       'answer'      => $firstoption->id,
                   ]);
               }elseif($correct[$key]=="option2")
               {
                   QuestionAnswer::create([
                       'setquestion_id' => $myquestion->id,
                       'answer'      => $secondoption->id,
                   ]);
               }
               elseif($correct[$key]=="option3")
               {
                   QuestionAnswer::create([
                       'setquestion_id' => $myquestion->id,
                       'answer'      => $thirdoption->id,
                   ]);
               }
               elseif($correct[$key]=="option4")
               {
                   QuestionAnswer::create([
                       'setquestion_id' => $myquestion->id,
                       'answer'      => $fouroption->id,
                   ]);
               }
       }
       Toastr::success('Set Off Question  Create successfully!','Success');
       return redirect()->route('question.index');
    }catch (\Exception $e) {
        Toastr::warning('Set Off Question  Not Create)','warning');
        return back();
    }

   }
   public function combained_store(Request $request)
   {
       $validator = Validator::make($request->all(), [
           'question' => 'required',
           'mark'=>'required',
           'defficult_level'=>'required',
           'mcq_defficult_level'=>'required',
       ]);

       if ($validator->fails()) {
           return redirect()->back()
                       ->withErrors($validator)
                       ->withInput();
       }

       $chapter=Question::where('id',$request->question_id)->select('chapter_id')->first();
       $subject=Chapter::where('id',$chapter->chapter_id)->select('subject_id')->first();
       $question_id=$request->question_id;
       //writen
       $question = $request->question;
       $mark = $request->mark;
       $rubric=$request->rubric;
       $defficult_level=$request->defficult_level;
       //mcq
       $mc_question=$request->mc_question;
       $mc_mark=$request->mc_mark;
       $correct = $request->correct;
       $option1=$request->option1;
       $option2=$request->option2;
       $option3=$request->option3;
       $option4=$request->option4;
       $mcq_defficult_level=$request->mcq_defficult_level;
      foreach($question as $key => $no)
        {
        $input['question'] = strip_tags($question[$key]);
        $input['mark'] = $mark[$key];
        $input['rubric'] = strip_tags($rubric[$key]);
        $input['question_id']=$question_id;
        $input['chapter_id']=$chapter->chapter_id;
        $input['subject_id']=$subject->subject_id;
        $input['defficult_level']=$defficult_level[$key];
        $input['user_id']=Auth::user()->id;
        $input['draft']=1;
        $input['status']=0;
        $myquestion= SetQuestion::create($input);
        }
        foreach($mc_question as $key =>$value)
        {
        $input['question'] = strip_tags($mc_question[$key]);
        $input['mark'] = $mc_mark[$key];
        $input['chapter_id']=$chapter->chapter_id;
        $input['subject_id']=$subject->subject_id;
        $input['defficult_level']=$mcq_defficult_level[$key];
        $input['rubric'] ='';
        $input['question_id']=$question_id;
        $input['user_id']=Auth::user()->id;
        $input['draft']=1;
        $input['status']=0;

        $my_mcq_question= SetQuestion::create($input);
            $firstoption=QuestionMcq::create([
            'setquestion_id' => $my_mcq_question->id,
            'option'      => strip_tags($option1[$key]),
            ]);

            $secondoption=QuestionMcq::create([
                'setquestion_id' => $my_mcq_question->id,
                'option'      => strip_tags($option2[$key]),
                ]);

             $thirdoption=QuestionMcq::create([
                'setquestion_id' => $my_mcq_question->id,
                'option'      => strip_tags($option3[$key]),
                ]);

                $fouroption=QuestionMcq::create([
                'setquestion_id' => $my_mcq_question->id,
                'option'      => strip_tags($option4[$key]),
                ]);
                if($correct[$key]=="option1"){
                    QuestionAnswer::create([
                        'setquestion_id' => $my_mcq_question->id,
                        'answer'      => $firstoption->id,
                    ]);
                }elseif($correct[$key]=="option2")
                {
                    QuestionAnswer::create([
                        'setquestion_id' => $my_mcq_question->id,
                        'answer'      => $secondoption->id,
                    ]);

                }
                elseif($correct[$key]=="option3")
                {
                    QuestionAnswer::create([
                        'setquestion_id' => $my_mcq_question->id,
                        'answer'      => $thirdoption->id,
                    ]);
                }
                elseif($correct[$key]=="option4")
                {
                    QuestionAnswer::create([
                        'setquestion_id' => $my_mcq_question->id,
                        'answer'      => $fouroption->id,
                    ]);
                }
        }
        Toastr::success('Set Off Question  Create successfully!','Success');
        return redirect()->route('question.index');

   }

   public function questionset_edit($id)
   {
        if(Gate::allows('questionset.edit')){
            $setquestion=SetQuestion::where('question_id',$id)->get();
            return view('question.gestionset_edit',compact('setquestion'));
        }else{
             Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
   }

   public function questionset_update(Request $request,$id)
   {
        $question=DB::table("set_questions")
        ->where('id',$id)
        ->update([
            'question' => $request->question,
            'mark'=>$request->mark,
            'rubric'=>$request->rubric,
            'defficult_level'=>$request->defficult_level
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

        return response()->json([
            'success' => true,
            'message' => 'Question Update Successfully!'
            ]);

       }
       public function questionset_delete($id)
       {
           if(Gate::allows('questionset.destroy')){
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
       public function questionset_preview($id)
       {
           if(Gate::allows('questionset.preview')){
               $setquestion=SetQuestion::where('question_id',$id)->get();
               return view('question.preview',compact('setquestion'));
           }else{
                Toastr::error('Do Not Give You Permission!','error');
               return back();
           }
       }
}
