<?php

namespace App\Http\Controllers\Ajax;

use App\Models\User;
use App\Models\Batch;
use App\Models\Chapter;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Inastitute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserAssigned;
use RealRashid\SweetAlert\Facades\Alert;

class AjaxController extends Controller
{
   
  
    public function get_sorting_user(Request $request,$user_id)
    {
        $data=UserAssigned::with('course','batch','role')->where('user_id',$user_id)->get();
        if ($request->ajax()) {
            return view('t_user.table', compact('data'));
        }
        return view('t_user.create', compact('data'));
    }

    public function get_user_info(Request $request,$id)
    {
        $data=User::with('batch','role')->where('id',$id)->first();
        if ($request->ajax()) {
            return view('t_user.info', compact('data'));
        }
        return view('t_user.index', compact('data'));
    }


    public function get_chapter($id)
    {
        $chapters = DB::table("topic_types")
        ->where("questionbank_id",$id)->get();
        foreach($chapters as $chap){
            $data=DB::table('set_questions')->where('chapter_id',$chap->id)->where('status',0)->get();
        }
        return json_encode($data);
    }

    public function get_schapter(Request $request)
    {
        $subject_id = $request->subject_id;
        $data =Chapter::where("subject_id",$subject_id)->get();
        return json_encode($data);
    }
    public function getbatch($course_id)
    {
        try{
            $batches=Batch::where('course_id', $course_id)->get();
            return response()->json([
                'batches' => $batches,
            ]);
        }catch(\Exception $e) {
            Alert::error('Something went wrong!', 'error');
            return back();
        }
    }
    public function getuser($batch_id)
    {
        try{
            $users=User::where('batch_id', $batch_id)->where('role_id',4)->get();
            return response()->json([
                'users' => $users,
            ]);
        }catch(\Exception $e) {
            Alert::error('Something went wrong!', 'error');
            return back();
        }
    }
}
