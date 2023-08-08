@extends('layouts.app') @push('css')
<style type=""></style>
@endpush @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-9">
                <h1 class="m-0 text-dark">Forum Create</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-3">
                <div class="d-inline p-2 text-white text-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                </div>

                <div class="d-inline p-2 text-white text-right">
                    <a href="{{ route('private_forum.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
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
                <form action="{{route('private_forum.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="forumcategory_id">Category</label>
                        <select class="searchable_select form-control @error('forumcategory_id') is-invalid @enderror" id="forumcategory_id" name="forumcategory_id">
                            <option value="">Select Category</option>
                            @foreach ($forumcategorys as $forumcategory)
                            <option value="{{ $forumcategory->id }}" @isset($trainee) {{ $role->id==$trainees->userinfo->role_id ?'selected' : '' }} @endif>{{ $forumcategory->name }}</option>
                            @endforeach
                        </select>
                        @error('forumcategory_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{old('title')}}" class="form-control @error('title') is-invalid @enderror " placeholder="Title">
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="5" id="" name="description" class="noting @error('description') is-invalid @enderror">{{old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-success" value="Create" />
                </form>
                <br />
                <br />
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js')
<script>
    $(function() {
        $('#summernote').summernote({
            height: 200
        });
    });
</script>
@endpush
