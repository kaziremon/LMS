<?php

namespace App\Http\Controllers;

use DB;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ForumReplyController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'comment' => ['required', 'string'],
        ]);
        ForumReply::create([
            'comment'=>strip_tags($request->comment),
            'forum_id'=>$request->forum_id,
            'user_id'=>Auth::user()->id,
        ]);
        Toastr::success('Your Comment Add successfully!','Success');
        return back();
    }

    public function destroy($id)
    {
         $reply=ForumReply::find($id);
          $user=Auth::user()->id;
    
        if($reply->user_id==$user)
        {
            $reply->delete();
            return back();
        }else{
            return back();
        }
    }

    public function edit($id)
    {
        
        $reply=ForumReply::find($id);
	    return response()->json([
	      'data' => $reply
	    ]);
    }

    public function update(Request $request)
    {
 
        $test=DB::table('forum_replies')
                        ->where('id', $request->hidden_id)
                        ->update([
                            'comment' => $request->editcomment,
                            ]
                        );
            return response()->json(
            [
                'success' => true,
                'message' => 'Comment Updated'
            ]
        );
    }
}
