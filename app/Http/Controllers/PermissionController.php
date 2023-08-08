<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\PermissionPostRequest;
use App\Http\Requests\PermissionUpdateRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('permissions.index')) {
            $permissions=Permission::all();
            return view('permissions.index', compact('permissions'));
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
        if (Gate::allows('permissions.create')) {
            $modules=Module::all();
            return view('permissions.from', compact('modules'));
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
    public function store(PermissionPostRequest $request)
    {
        Permission::create([
            'name' =>$request->name,
            'module_id'=>$request->module_id,
            'slug' =>$request->slug ?? Str::slug($request->name),
        ]);
        Toastr::success('Permission Create successfully!','Success');
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        if (Gate::allows('permissions.edit')) {
            $modules=Module::all();
            return view('permissions.from', compact('modules', 'permission'));
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
            if (Gate::allows('permissions.edit')) {
        $permission->update([
                'name' =>$request->name,
                'module_id'=>$request->module_id,
                'slug' =>$request->slug ?? Str::slug($request->name),
            ]);
            Toastr::success('Permission Update successfully!','Success');
            return redirect()->route('permissions.index');
            }else{
                Alert::error('Do Not Give You Permission!', 'error');
                return back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if (Gate::allows('permissions.destroy')) {
            $permission->delete();
            Toastr::success('Permission Delete successfully!','Success');
            return back();
        }else{
            Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
