<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Faker\Provider\UserAgent;
use App\Mail\UserAssignedMail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Batch;
use App\Models\Course;
use App\Models\UserAssigned;
class UserAssignedController extends Controller
{
    public function index()
    {
        
        if (Gate::allows('user_assigned.index')) {      
            $users=User::where('role_id',3)->OrWhere('role_id',4)->get();
            return view('t_user.index',compact('users'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function create()
    {
        if (Gate::allows('user_assigned.create')) {      
            $courses=Course::all();
            $users=User::where('role_id',3)->OrWhere('role_id',4)->get();
            return view('t_user.create',compact('courses','users'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
     
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'=>'required',
            'course_id' =>'required',
            'batch_id' =>'required',
        ]);
        $role=User::where('id',$request->user_id)->first();
        UserAssigned::create([
            'user_id' =>$request->user_id,
            'course_id'=>$request->course_id,
            'batch_id' =>$request->batch_id,
            'role_id' =>$role->role_id,
        ]);

        $user=User::where('id',$request->user_id)->first();

        $user->update([
            'course_id'=>$request->course_id,
            'batch_id' =>$request->batch_id,
        ]);
        $course=Course::where('id',$request->course_id)->first();
        $batch=Batch::where('id',$request->batch_id)->first();
        $info=[
            'course' =>$course->title,
            'batch' => $batch->name,
        ];
        Mail::to($user->email)->send(new UserAssignedMail($info));
        Toastr::success('User Assigned successfully!','Success');
        return redirect()->route('assigned.user');
    }

    public function show($id)
    {
        if (Gate::allows('user_assigned.show')) {      
            $users=UserAssigned::with('course','batch','role')->where('user_id',$id)->get();
            return view('t_user.view',compact('users'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }

         
    }

    public function destroy($id)
    {
        if (Gate::allows('user_assigned.destroy')) {
            $userassigned=UserAssigned::find($id);
            $userassigned->delete();
            Toastr::success('Delete successfully!','Success');
            return back();
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
