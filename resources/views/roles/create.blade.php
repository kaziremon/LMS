@extends('layouts.app')

@push('css')
@endpush

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @isset($role)
                <h1 class="m-0 text-dark">Roles Edit</h1>
                @else
                <h1 class="m-0 text-dark">Roles Create</h1>
                @endisset
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                @isset($role)
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('roles.create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> Create</a>
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </ol>
                @else
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{route('roles.index')}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </ol>
                @endisset
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12 col-x-12 col-sm-12">
                <form action="{{ isset($role) ? route('roles.update',$role->id) : route('roles.store') }}" method="POST">
                    @csrf
                    @isset($role)
                    @method('PUT')
                    @endisset
                    <div class="card-body">
                        <!-- <h5 class="card-title"> Manage Role</h5> -->
                        <div class="form-group">
                            <label for="inputStatus">Role Name</label>
                            <input id="name" type="text" placeholder="Enter Role Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name') }}" />
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <strong>Manage Permission For Role</strong> <br>
                            @if($errors->has('permissions'))

                            <strong style="color:red;">The Permission field is requied</strong>

                            @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="select-all">
                                <label for="select-all" class="custom-control-label">Select All</label>
                            </div>
                        </div>
                        @forelse ( $modules->chunk(3) as $key=>$chunks)
                        @foreach ($chunks as $key=> $module)

                        <div class="col">
                            <h5>Module: {{ $module->name }}</h5>

                            @foreach ($module->permissions as $key=>$permission)
                            <div class="mb-3 ml-4">
                                <div class="custom-control custom-checkbox mb-2">
                                    <input type="checkbox" class="custom-control-input" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" @isset($role) @foreach ($role->permissions as $rPermission)
                                    {{ $rPermission->id==$permission->id ? 'checked' :'' }}
                                    @endforeach
                                    @endisset
                                    >
                                    <label for="permission-{{ $permission->id }}" class="custom-control-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>

                            @endforeach
                        </div>

                        @endforeach

                        @empty

                        <div class="row">
                            <div class="col text-center">
                                <h5>No Module Found</h5>
                            </div>
                        </div>

                        @endforelse
                    </div>
                    <div class="col-md-12 col-xl-12 col-sm-12">
                        <div class="col-md-6 col-xl-6 col-sm-12">
                            @isset($role)
                            <input type="submit" class="btn btn-lg btn-primary ml-15" value="Update">
                            @else
                            <input type="submit" class="btn btn-lg btn-success" value="Create">
                            @endisset
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('js')
<script>
    $('#select-all').click(function(event) {
        if (this.checked) {
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });
</script>
@endpush
