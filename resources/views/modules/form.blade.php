@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @isset($module)
                <h1 class="m-0 text-dark">Module Edit</h1>
                    @else
                    <h1 class="m-0 text-dark">Module Create</h1>
                @endisset
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                @isset($module)
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('modules.create')
                        <a href="{{ route('modules.create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> Create</a>
                        @endcan
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </ol>
                @else
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{route('modules.index')}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
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
                <form action="{{ isset($module) ? route('modules.update',$module->id) : route('modules.store') }}" method="POST">
                    @csrf @isset($module) @method('PUT') @endisset
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" type="text" placeholder="Module Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $module->name ?? old('name') }}" />
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @isset($module)
                        <input type="submit" class="btn btn-danger" value="Update" />
                        @else
                        <input type="submit" class="btn btn-danger" value="Create" />
                        @endisset
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js') @endpush
