@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Chapter Edit</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                 <div class="d-inline p-2 text-white text-right float-right" >
                      @can('chapter.index')
                        <a href="{{ route('chapter.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                     @endcan
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
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
                <form action="{{route('chapter.update',$chapter->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="subject_id">Subject</label>
                        <select name="subject_id" class="js-example-basic-single form-control @error('subject_id') is-invalid @enderror">
                            <option value="">Session Your Subject</option>
                            @foreach($subjects as $sub)
                            <option value="{{$sub->id}}" {{$sub->id==$chapter->subject_id ?'selected' : ''}}>{{ $sub->title }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Topics Name</label>
                        <input name="name" id="name" type="name" placeholder="name" class="form-control @error('name') is-invalid @enderror" title="Name" value="{{$chapter->name}}" />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="learning_outcome">Learning Out Come</label>
                        <textarea name="learning_outcome" class="form-control @error('learning_outcome') is-invalid @enderror" id="learning_outcome" rows="3" title="Learning Out Come">{{$chapter->learning_outcome}}</textarea>
                        @error('learning_outcome')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-danger" value="Update" />
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
