@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Exam Create</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                 <div class="d-inline p-2 text-white text-right float-right" >
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
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
                <form action="{{route('exam.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exam_title">Exam Title</label>
                        <input name="exam_title" id="exam_title" type="text" placeholder="Title" class="form-control @error('exam_title') is-invalid @enderror" title="exam_title" value="{{old('exam_title') }}" />
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
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
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


                        </select>
                        @error('batch_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group" id="">
                        <label for="date">Date</label>
                        <input name="date" id="txtDate" type="date" placeholder="Date" class="form-control @error('date') is-invalid @enderror" title="date" value="{{ $exam->date ?? old('date') }}" />
                        @error('date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <input name="start_time" type="time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ $exam->start_time ?? old('start_time') }}" />
                        @error('start_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <input name="end_time" id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" value="{{ $exam->end_time ?? old('end_time') }}" />
                        @error('end_time')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <input type="submit" class="btn btn-danger" value="Create" />
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

<script type="text/javascript">
    $(function(){
        var dtToday = new Date();
        
        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();
        
        var maxDate = year + '-' + month + '-' + day;
        $('#txtDate').attr('min', maxDate);
    });
</script>
@endpush
