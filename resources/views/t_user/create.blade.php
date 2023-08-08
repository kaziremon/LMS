@extends('layouts.app') @push('css') @endpush @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2 text-dark" style="font-size: 26px; font-weight: bold;">User Assigned</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                    <li>
                        <a href="{{ route('home') }}" class="btn btn-info btn-sm m-1"><i class="fas fa-home"></i> Home</a>
                    </li>
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
                <form class="" id="ajax-contact-form" action="{{ url('user/assigned/store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-4 col-xs-6 col-sm-4">
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
                        </div>
                        <div class="col-md-4 col-xs-6 col-sm-4">
                            <div class="form-group">
                                <label for="roles">Batch Name</label>
                                <select id="selectBatch" class="js-example-basic-single form-control @error('batch_id') is-invalid @enderror" name="batch_id"> </select>
                                @error('batch_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-4 col-sm-4">
                            <div class="form-group">
                                <label for="user">User Name</label>
                                <select id="user_id" class="js-example-basic-single form-control @error('user_id') is-invalid @enderror" name="user_id">
                                    <option value="">Select Course</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                         <input type="submit" class="btn btn-lg btn-success" value="Create">
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div id="view"></div>
                        </div>
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
    $(document).ready(function () {
        $(".js-example-basic-single").select2();
    });
    //Date picker
    $("#reservationdate").datetimepicker({
        format: "YYYY/MM/DD",
    });
</script>
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
<script>
    $('select[name="user_id"]').on("change", function () {
        var user_id = $(this).val();
        // var upazila_id = $('#upazila_id').val();
        $.get("/assigned/user/list/" + user_id, function (data) {
            $data = $(data);
            $("#view").hide().html($data).fadeIn();
        });
        event.preventDefault();
    });

    // $("#defaultCheck input:checkbox").change(function() {
    //     var ischecked= $(this).is(':checked');
    //     if(!ischecked)
    //     alert('uncheckd ' + $(this).val());
    // });

    function getvalue(id) {
        var ischecked = $(this).is(":checked");
        $.get("/get/user/info/" + id, function (data) {
            $data = $(data);
            $("#info").hide().html($data).fadeIn();
        });
    }
</script>

@endpush
