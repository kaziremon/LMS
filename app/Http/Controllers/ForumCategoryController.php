<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ForumCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class ForumCategoryController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('forum_category.index')) {
            $items=ForumCategory::latest()->get();
            return view('forum.category.index',compact('items'));
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
        if(Gate::allows('forum_category.create')) {
            return view('forum.category.create');
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
        ]);
        ForumCategory::create([
            'name' =>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        Toastr::success('Forum Category Create successfully!','Success');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::allows('forum_category.edit')) {
            $forumcategory=ForumCategory::find($id);
            return view('forum.category.edit',compact('forumcategory'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' =>'required', 'string',
        ]);

        $forumcategory=ForumCategory::find($id);
        $forumcategory->update([
            'name' =>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        Toastr::success('Forum Category Update successfully!','Success');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::allows('forum_category.destroy')) {
            $forumcategory=ForumCategory::find($id);
            $forumcategory->delete();
            Toastr::success('Forum Category Delete successfully!','Success');
            return back();
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
