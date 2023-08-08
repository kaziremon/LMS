<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Module;
use App\Models\QuestionBank;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ModulePostRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ModuleUpdateRequest;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('modules.index')) {
        $modules=Module::all();
        return view('modules.index',compact('modules'));
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
        if (Gate::allows('modules.create')) {
            return view('modules.form');
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
    public function store(ModulePostRequest $request)
    {
        Module::create([
            'name' =>$request->name,
        ]);
        // Alert::success('Module Create successfully!', 'success');
        Toastr::success('Module Create successfully!','Success');
        return redirect()->route('modules.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        if (Gate::allows('modules.edit')) {
            return view('modules.form', compact('module'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleUpdateRequest $request, Module $module)
    {
        $this->validate($request, [
            'name' =>'required', 'string','unique:modules,name,'.$module->id.'id,deleted_at,NULL',
        ]);

        $module->update([
            'name' =>$request->name,
        ]);
        Alert::success('Module Updated successfully!', 'success');
        return redirect()->route('modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        if (Gate::allows('modules.destroy')) {
            $module->delete();
            Alert::success('Module Deleted successfully!', 'success');
            return back();
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
