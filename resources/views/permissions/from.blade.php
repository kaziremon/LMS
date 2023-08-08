@extends('layouts.app') @push('css')
@endpush @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @isset($permission)
                <h1 class="m-0 text-dark">Permission Edit</h1>
                @else
                <h1 class="m-0 text-dark">Create Permission</h1>
                @endisset

            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                @isset($permission)
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('permissions.create')
                        <a href="{{ route('permissions.create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> Create</a>
                        @endcan
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </ol>
                @else
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{route('permissions.index')}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
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
                <form action="{{ isset($permission) ? route('permissions.update',$permission->id) : route('permissions.store') }}" method="POST">
                    @csrf @isset($permission) @method('PUT') @endisset

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <!-- <h5 class="card-title">Manage Permission</h5>
                                <br>
                                <br /> -->
                                <div class="form-group row">
                                    <label for="name" class="col-sm-4 col-form-label">Permission Name</label>
                                    <div class="col-sm-8">
                                        <input id="name" type="text" placeholder="Permission Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $permission->name ?? old('name') }}" />
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="module_id" class="col-sm-4 col-form-label">Module Name</label>
                                    <div class="col-sm-8">
                                       <div class="form-group row">
                                        <select class="js-example-basic-single form-control @error('module_id') is-invalid @enderror" id="module_id" name="module_id">
                                            <option value="">Select User Module</option>
                                            @foreach ($modules as $module)
                                            <option value="{{ $module->id }}" @isset($permission) {{ $module->id==$permission->module_id ?'selected' : '' }} @endif>{{ $module->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('module_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                       </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="slug" class="col-sm-4 col-form-label">Slug</label>
                                    <div class="col-sm-8">
                                        <input id="slug" type="text" placeholder="Slug" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ $permission->slug ?? old('slug') }}" />
                                        @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"> </div>
                    </div>
                        <div class="row">
                            <div class="col-md-6"> </div>
                            <div class="col-md-3">
                                @isset($permission)
                                <input type="submit" class="btn btn-block btn-info" value="Update" />
                                @else
                                <input type="submit" class="btn btn-info btn-block" value="Create" />
                                @endisset
                            </div>
                            <div class="col-md-3"> </div>
                        </div>
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js')
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
