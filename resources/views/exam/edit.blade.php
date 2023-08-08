@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Exam Edit</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                 <div class="d-inline p-2 text-white text-right float-right" >
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    <a href="{{route('exam.create')}}" class="btn btn-md btn-success btn-sm"><i class="fas fa-plus"></i> Create</a>
                    <a href="{{ route('exam.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
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
                <form action="{{route('exam.update',$exam->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exam_title">Exam Title</label>
                        <input name="exam_title" id="exam_title" type="text" placeholder="Title" class="form-control @error('exam_title') is-invalid @enderror" title="exam_title" value="{{$exam->exam_title}}" />
                        @error('exam_title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="course">Course Name</label>
                        <select id="selectCourse" class="js-example-basic-single form-control @error('course_id') is-invalid @enderror" name="course_id">
                            <option value="">Select Course</option>
                            @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{$course->id==$exam->course_id ? 'selected' : ''}}>{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="roles">Batch Name</label>
                        <select id="selectBatch" class="js-example-basic-single form-control @error('batch_id') is-invalid @enderror" name="batch_id">
                            <option @isset($exam->batch_id) value="{{$exam->batch_id}}" @endisset> @isset($exam->batch->name) {{$exam->batch->name}} @endisset</option>
                        </select>
                        @error('batch_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input name="date" id="date" type="date" placeholder="Date" class="form-control @error('date') is-invalid @enderror" title="date" value="{{ $exam->date}}" />
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input name="start_time" type="time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ $exam->start_time}}" />
                        @error('start_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input name="end_time" id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" value="{{ $exam->end_time}}" />
                        @error('end_time')
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
<script type="text/javascript">
       $(document).ready(function() {
        $('select[name="course_id"]').on('change', function() {
            var course_id = $(this).val();
            if (course_id) {
                $.ajax({
                    url: '/get/batch/' + course_id ,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var res = '<option value="">Select Batch</option>';
                        $.each(data.batches, function(key, value) {
                            res +=
                                '<option value="'+ value.id +'">'+ value.name +'</option>';
                        });
                        $('select[name="batch_id"]').html(res);
                    }

                });

            }
        });
    });
</script>


@endpush
