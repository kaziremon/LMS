@extends('layouts.app') @push('css') @endpush @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-9">
                <h1 class="m-0 text-dark">Forum Category Create</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-3">
                <div class="d-inline p-2 text-white text-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                </div>
                @can('private_forum_category.index')
                <div class="d-inline p-2 text-white text-right">
                    <a href="{{ route('private_category.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
                @endcan
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
                <form action="{{route('private_category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input id="name" type="text" placeholder="Forum Category Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name') }}" />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-success" value="Create" />
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js') @endpush
