<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class UserProfileController extends Controller
{
    public function showuserProfile()
    {
        return view('users.profile');
    }
    public function profile(Request $request){

        $this->validate($request, [
            'name' => 'required','string', 'max:20','unique:users,name,'.Auth::user()->id,
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users,name,'.Auth::user()->id,
            'description' => ['nullable','min:15', 'max:300'],
            'full_name'=>['required'],
            'newpassword' =>['nullable','string','min:6'],
            'profile_pic'        =>'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if(isset($request->oldpassword) || isset($request->newpassword)){
            $this->validate($request, [
                'newpassword' =>['required', 'string', 'min:6'],
                'oldpassword'=>'required'
            ]);
        }

        if($request->name){
            $name = User::where('name',Auth::user()->name)->where('id',Auth::user()->id)->first();
            if ($name) {
                try {
                   $name->update(['name' =>$request->name]);
                } catch (\PDOException $e) {
                    Session::put(['message.error' => $e->getMessage()]);
                }
            } 
        }
        if($request->email){
            $email = User::where('email',Auth::user()->email)->where('id',Auth::user()->id)->first();
            if ($email) {
                try {
                   $email->update(['email' =>$request->email]);
                } catch (\PDOException $e) {
                    Session::put(['message.error' => $e->getMessage()]);
                }
            } 
        }
        if($request->full_name){
            $full_name = User::where('full_name',Auth::user()->full_name)->where('id',Auth::user()->id)->first();
            if ($full_name) {
                try {
                   $full_name->update(['full_name' =>$request->full_name]);
                } catch (\PDOException $e) {
                    Session::put(['message.error' => $e->getMessage()]);
                }
            } 
        }
        if(isset($request->oldpassword) || isset($request->newpassword)){
            $hashedPassword = Auth::user()->password;
            if (Hash::check($request->oldpassword , $hashedPassword)) {
                if (!Hash::check($request->newpassword ,$hashedPassword)) {
                    $password = User::where('password',$hashedPassword)->where('id',Auth::user()->id)->first();
                    if ($password) {
                        try {
                           $password->update(['password' =>Hash::make($request->newpassword)]);
                        } catch (\PDOException $e) {
                            Session::put(['message.error' => $e->getMessage()]);
                        }
                    } 
                }
                else{
                    return back()->with('error', 'Sorry! New password can not be the old password!');
                } 
            }
            else{
                return back()->with('error', 'Old password does not matched!!');
            }
    }

    if($request->profile_pic){
        $user = User::where('id',Auth::user()->id)->first();
            if($user){
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
                'profile_pic'=>$profile_pic,
            ]);
        }   
    }
    Toastr::success('Your Profile Update  successfully!)','Success');
    // return back()->with('success', 'Your Information Updated');
    return back();
    }
}
