<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Mail\UserMailSend;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::allows('users.index')){
            $users=User::all();
            return view('users.index',compact('users'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Gate::allows('users.create')){
            if(Auth::user()->role_id==1){
                $roles=Role::all();
            }else{
                $roles=Role::where('id','!=',1)->where('id','!=',2)->get();
            }
            return view('users.create',compact('roles'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserPostRequest $request)
    {

        User::create([
            'name' =>$request->name,
            'role_id'=>$request->role_id,
            'email'=>$request->email,
            'full_name'=>$request->full_name,
            'profile_pic'=>$this->imageUpload($request, 'profile_pic', 'uploads/profile_pic') ?? '',
            'password' => Hash::make($request->password),
            'is_active'=>$request->is_active,
        ]);

        $user=[
            'name' => $request->name,
            'email'=>$request->email,
            'password' =>$request->password,
        ];

        Mail::to($request->email)->send(new UserMailSend($user));
        Toastr::success('User Create Successfully','success');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if (Gate::allows('users.edit')) {
            if(Auth::user()->role_id==1){
                $roles=Role::all();
            }else{
                $roles=Role::where('id','!=',1)->where('id','!=',2)->get();
            }
            return view('users.create', compact('roles', 'user'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $profile_pic = '';
        if ($request->hasFile('profile_pic')) {
            if (!empty($user->profile_pic) && file_exists($user->profile_pic)) {
                unlink($user->profile_pic);
            }
            $profile_pic = $this->imageUpload($request, 'profile_pic', 'uploads/profile_pic');
        }else{
            $profile_pic = $user->profile_pic;
        }


        $user->update([
            'name' =>$request->name,
            'role_id'=>$request->role_id,
            'email'=>$request->email,
            'full_name'=>$request->full_name,
            'profile_pic'=>$profile_pic,
            'password' => Hash::make($request->password),
            'is_active'=>$request->is_active,
        ]);
        Toastr::success('User Information Update Successfully!','success');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Gate::allows('users.destroy')) {
            $user->delete();
            Toastr::success('User Deleted Successfully!','success');
            return back();
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
