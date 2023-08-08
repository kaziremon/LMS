@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @isset($course)
                <h1 class="m-0 text-dark">Course Edit</h1>
                    @else
                    <h1 class="m-0 text-dark">Course Create</h1>
                @endisset
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    </div>
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('course.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                    </div>
                </ol>
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
                <form action="{{ isset($course) ? route('course.update',$course->id) : route('course.store') }}" method="POST">
                    @csrf @isset($course) @method('PUT') @endisset
                        <div class="form-group">
                            <label for="title">Course Title</label>
                            <input name="title" id="title" type="text" placeholder="title" class="form-control @error('title') is-invalid @enderror" title="title" value="{{ $course->title ?? old('title') }}" />
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        @isset($course)
                        <button type="submit" class="btn btn-primary" value="Update">Update</button>
                        @else
                        <button type="submit" class="btn btn-primary" value="Create">Create</button>
                        @endisset
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js')
@endpush
