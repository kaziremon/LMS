<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Forum;
use App\Models\ForumReply;
use Illuminate\Http\Request;
use App\Models\ForumCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class ForumController extends Controller
{
    public function index()
    {
        if(Gate::allows('forum.index')) {
            $forums=Forum::with('user')->latest()->get();
            return view('forum.index',compact('forums'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }


    public function create()
    {
        if(Gate::allows('forum.create')) {
            $forumcategorys=ForumCategory::latest()->get();
            return view('forum.create',compact('forumcategorys'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'forumcategory_id' => ['required'],
        ]);
        Forum::create([
            'title' =>$request->title,
            'description'=>strip_tags($request->description),
            'forumcategory_id'=>$request->forumcategory_id,
            'user_id'=>Auth::user()->id,
        ]);
        Toastr::success('Forum Create successfully!','Success');
        return redirect()->route('forum.index');
    }

    public function edit($id)
    {
        if(Gate::allows('forum.edit')) {
            $forumcategorys=ForumCategory::all();
            $forum=Forum::find($id);
            return view('forum.edit',compact('forum','forumcategorys'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'forumcategory_id' => ['required'],
        ]);
        $forum=Forum::find($id);
       $forum->update([
            'title' =>$request->title,
            'description'=>strip_tags($request->description),
            'forumcategory_id'=>$request->forumcategory_id,
            'user_id'=>Auth::user()->id,
        ]);
        Toastr::success('Forum Update successfully!','Success');
        return redirect()->route('forum.index');
    }

    public function details($id)
    {
        if(Gate::allows('forum.details')) {
            $forum=Forum::find($id);
            $replys=ForumReply::with('user')->where('forum_id',$forum->id)->get();
            $user=Auth::user()->id;
            $favourit=DB::table("favourites")
            ->where("forum_id",$forum->id)
            ->Where('user_id',$user)
            ->first();
            $count=DB::table("favourites")
            ->where("forum_id",$id)->count();
            return view('forum.details',compact('forum','replys','favourit','count'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function destroy($id)
    {

        if(Gate::allows('forum.destroy')) {
            $forum=Forum::find($id);
            $forum->delete();
            Toastr::success('Forum Delete successfully!','Success');
            return redirect()->route('forum.index');
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    public function favorit($id)
    {
        $user=Auth::user()->id;
        $favourit=DB::table("favourites")
        ->where("forum_id",$id)
        ->orWhere('user_id',$user)
        ->get();
        return response()->json([
           'favourit'=>$favourit,
       ]);
    }

    public function add_favoruit(Request $request)
    {
        DB::table('favourites')->insert([
            'forum_id' => $request->forum_id,
            'favourit' => '1',
            'user_id' => $request->user_id,
        ]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Add To Favourites List'
            ]
        );
    }

    public function remove_favoruit(Request $request)
    {
        DB::table('favourites')->where('forum_id',$request->forum_id)
                                ->Where('user_id',$request->user_id)
                                ->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Remove From Favourites List'
            ]
        );
    }
}
