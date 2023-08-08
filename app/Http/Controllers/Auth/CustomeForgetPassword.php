<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ForgetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class CustomeForgetPassword extends Controller
{
    public function showForgetPasswordForm()
    {
       return view('auth.forgetPassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(20);
        $user=User::where('email',$request->email)->first();
        $pass = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&"), 0, 8);
        $info=[
            'name' => $user->name,
            'url' => $token,
            'password' => $pass,
        ];
        if($user){
            $user=DB::table('forget_passwords')->insert([
                'email' => $request->email,
                'user_id' => $user->id,
                'url' => $token,
                'password'=>$pass,
            ]);
            Mail::to($request->email)->send(new ForgetPassword($info));
            Alert::success('Your Password Send To Your Email!', 'success');
            return back();
        }else{
            Alert::success('Your Email Not Found!', 'error');
            return back();
        }

    }

    public function forget_url($url)
    {
        $urlcheck=DB::table('forget_passwords')->where('url',$url)->first();
        if($urlcheck){
            return view('auth.forgetPasswordLink', ['token' => $url]);
        }else{
            return redirect('/login')->with('message', 'Your password has been changed!');
        }
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('forget_passwords')
                            ->where([
                              'password' => $request->password,
                              'url'=>$request->url,
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $updatePassword->email)
                    ->update(['password' => Hash::make($request->password)]);

      DB::table('forget_passwords')->where(['email' => $updatePassword->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
