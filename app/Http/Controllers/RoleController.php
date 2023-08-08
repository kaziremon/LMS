<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\RolePostRequest;
use App\Http\Requests\RoleUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('roles.create')) {
            if(Auth::user()->role_id==1){
                $roles=Role::all();
                return view('roles.index', compact('roles'));
            }else{
                $roles=Role::where('id','!=',1)->get();
                return view('roles.index', compact('roles'));
            }
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
        if (Gate::allows('roles.create')) {
            $modules=Module::all();
            return view('roles.create', compact('modules'));
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
    public function store(RolePostRequest $request)
    {
        Role::create([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),

        ])->permissions()->sync($request->input('permissions'),[]);
        Toastr::success('Role Create Successfully','success');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if (Gate::allows('roles.edit')) {
            $modules=Module::all();
            return view('roles.create', compact('modules', 'role'));
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {

        $role->update([
            'name'=>$request->name,
            'slug'=>Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions'));
        Toastr::success('Role Updated successfully!)','success');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        if (Gate::allows('roles.destroy')) {
            $role->delete();
            Toastr::success('Role Delete successfully!!)','success');
            return back();
        }else{
           Toastr::error('Do Not Give You Permission!','error');
            return back();
        }
    }
}
