<?php

namespace App\Http\Controllers\Administration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ModulePostRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ModuleUpdateRequest;
use App\Models\Module;
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
            Alert::error('Do Not Give You Permission!', 'error');
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
            Alert::error('Do Not Give You Permission!', 'error');
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
        Alert::success('Module Create successfully!', 'success');
        return redirect()->route('modules.index');
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
    public function edit(Module $module)
    {
        if (Gate::allows('modules.edit')) {
            return view('modules.form', compact('module'));
        }else{
            Alert::error('Do Not Give You Permission!', 'error');
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
    public function update(ModuleUpdateRequest $request,Module $module)
    {
        $module->update([
            'name' =>$request->name,
        ]);
        Alert::success('Module Updated successfully!', 'success');
        return redirect()->route('modules.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        if (Gate::allows('modules.destroy')) {
            $module->delete();
            Alert::success('Module Deleted successfully!', 'success');
            return back();
        }else{
            Alert::error('Do Not Give You Permission!', 'error');
            return back();
        }
    }
}
