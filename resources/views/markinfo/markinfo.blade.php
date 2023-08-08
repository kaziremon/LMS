@extends('layouts.app') @push('css') @endpush @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2 text-dark" style="font-size: 26px; font-weight: bold;">Mark Sheet</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1"><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
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

<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12 col-x-12 col-sm-12">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="form-group">
                            <label for="course">Course Name</label>
                            <select id="course_id" class="js-example-basic-single form-control @error('course_id') is-invalid @enderror" name="course_id">
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
                    </div>
                    <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="form-group">
                            <label for="batch">Batch Name</label>
                            <select id="batch_id" class="js-example-basic-single form-control @error('batch_id') is-invalid @enderror" name="batch_id"> </select>
                            @error('batch_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                     <div class="col-md-4 col-sm-4 col-lg-4">
                        <div class="form-group">
                            <label for="user">User</label>
                            <select id="user_id" class="js-example-basic-single form-control @error('user_id') is-invalid @enderror" name="user_id"> </select>
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div id="view"></div>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>

@endsection @push('js')
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="course_id"]').on("change", function () {
            var course_id = $(this).val();
            if (course_id) {
                $.ajax({
                    url: "/get/batch/" + course_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var res = '<option value="">Select Batch</option>';
                        $.each(data.batches, function (key, value) {
                            res += '<option value="' + value.id + '">' + value.name + "</option>";
                        });
                        $('select[name="batch_id"]').html(res);
                    },
                });
            }
        });
    });
    $(document).ready(function () {
        $('select[name="batch_id"]').on("change", function () {
            var batch_id = $(this).val();
            if (batch_id) {
                $.ajax({
                    url: "/get/batch/user/" + batch_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var res = '<option value="">Select User</option>';
                        $.each(data.users, function (key, value) {
                            res += '<option value="' + value.id + '">' + value.full_name + "</option>";
                        });
                        $('select[name="user_id"]').html(res);
                    },
                });
            }
        });
    });

    ///============================Mark view=====================
    $('select[name="user_id"]').on('change', function() {
            var user_id = $(this).val();
            var course_id = $('#course_id').val();
            var batch_id = $('#batch_id').val();
            $.get('/exam/student/mark/show/' + course_id + '/' + batch_id + '/' + user_id, function(data) {
                $data = $(data);
                $('#view').hide().html($data).fadeIn();
            });
            event.preventDefault();
        });
</script>
@endpush
