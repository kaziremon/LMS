<?php

namespace App\Http\Controllers\Administration;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        if (Gate::allows('permissions.create')) {
            $modules=Module::all();
            return view('permissions.from', compact('modules'));
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
    public function store(PermissionPostRequest $request)
    {
        Permission::create([
            'name' =>$request->name,
            'module_id'=>$request->module_id,
            'slug' =>$request->slug ?? Str::slug($request->name),
        ]);
        Alert::success('Permission Create successfully!', 'success');
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        if (Gate::allows('permissions.edit')) {
            $modules=Module::all();
            return view('permissions.from', compact('modules', 'permission'));
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
    public function update(PermissionUpdateRequest $request, Permission $permission)
    {
        if (Gate::allows('permissions.edit')) {
            $permission->update([
                'name' =>$request->name,
                'module_id'=>$request->module_id,
                'slug' =>$request->slug ?? Str::slug($request->name),
            ]);
            Alert::success('Permission Updated successfully!', 'success');
            return redirect()->route('permissions.index');
        }else{
            Alert::error('Do Not Give You Permission!', 'error');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if (Gate::allows('permissions.destroy')) {
            $permission->delete();
            Alert::success('Permission Deleted successfully!', 'success');
            return back();
        }else{
            Alert::error('Do Not Give You Permission!', 'error');
            return back();
        }
    }
}
