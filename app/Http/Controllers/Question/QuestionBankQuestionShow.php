<?php

namespace App\Http\Controllers\Question;

use App\Models\Chapter;
use App\Models\Subject;
use Mockery\Matcher\Subset;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
class QuestionBankQuestionShow extends Controller
{
    public function index()
    {
        if(Gate::allows('questionbankquestion.index')){
            $subject=Subject::all();
            $chapter=Chapter::all();
            return view('questionbankquestion.index',compact('subject','chapter'));
        }else{
            Alert::error('Do Not Give You Permission!', 'error');
            return back();
        }
    }

    public function show_question(Request $request,$subject_id,$chapter_id)
    {
        $data = DB::table("set_questions")
                ->where("subject_id",$subject_id)
                ->where('chapter_id',$chapter_id)
                ->where('status',1)
                ->get();
        if ($request->ajax()) {
            return view('questionbankquestion.show', compact('data'));
        }
        return view('questionbankquestion.index', compact('data'));
    }
}
