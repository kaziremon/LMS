@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @isset($batch)
                <h1 class="m-0 text-dark">Edit Batch</h1>
                @else
                <h1 class="m-0 text-dark">Create Batch</h1>
                @endisset
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                @isset($batch)
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('batch.create')
                        <a href="{{ route('batch.create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> Create</a>
                        @endcan
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </ol>
                @else
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('batch.index') }}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
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
            <div class="col-md-12 col-xs-12 col-sm-12">
                <form  action="{{ isset($batch) ? route('batch.update',$batch->id) : route('batch.store') }}" method="POST" class="from-hiden">
                    @csrf @isset($batch) @method('PUT') @endisset
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="course">Course Name</label>
                                    <select id="selectCourse" class="searchable_select form-control @error('course_id') is-invalid @enderror" name="course_id">
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                        <option name="course_id" value="{{ $course->id }}" @isset($batch){{$course->id==$batch->course_id ? 'selected' : ''}} @endisset>{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Batch Name</label>
                                    <input id="name" type="text" placeholder="Batch Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $batch->name ?? old('name') }}" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- <div class="col-md-3 col-xs-12 col-sm-3">
                                <div class="form-group">
                                    <label for="sizes">Memory Limit in MB</label>
                                    <input id="sizes" type="number" placeholder="Size Value" class="form-control @error('sizes') is-invalid @enderror" name="sizes" value="{{ $batch->sizes ?? old('sizes') }}" />
                                    @error('sizes')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> -->
                        </div>
                        @isset($batch)
                        <input type="submit" class="btn btn-info" value="Update" />
                        @else
                        <input type="submit" class="btn btn-info" value="Create" />
                        @endisset
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
</script>

@endpush

