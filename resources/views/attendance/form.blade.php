@extends('layouts.app')
@push('css')
    <style>
        .btn-success.disabled, .btn-success:disabled {
            color: #fff;
            background-color: #8f9390;
            border-color: #8a918b;
        }
        .btn-danger.disabled, .btn-danger:disabled {
            color: #fff;
            background-color: #8f9390;
            border-color: #8f9390;
        }
    </style>
@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @isset($attendance)
                <h1 class="m-0 text-dark">Attendance Edit</h1>
                @else
                <h1 class="m-0 text-dark">Attendance Create</h1>
                @endisset
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
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
                <form class="" id="ajax-contact-form" action="{{route('attendanceInsert') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label>Date</label>
                                <div class="date input-group" id="reservationdate" data-target-input="nearest">
                                    <input type="text" id="date" name="date" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <span id="dateerroremessage"></span>
                        </div>
                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label for="course">Course Name</label>
                                <select id="selectCourse" class="js-example-basic-single form-control @error('course_id') is-invalid @enderror" name="course_id">
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <span id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label for="venue">Venue Name</label>
                                <select id="selectVenue" class="js-example-basic-single form-control @error('venue_id') is-invalid @enderror" name="venue_id">


                                </select>
                                <span id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label for="roles">Batch Name</label>
                                <select id="selectBatch" class="js-example-basic-single form-control @error('batch_id') is-invalid @enderror" name="batch_id">


                                </select>
                                <span id="error"></span>
                            </div>
                        </div>
                        </div>
                    </div>
                        <div class="col-md-12 col-x-12 col-sm-12">
                            <table id="example1" class="table table-bordered attendance_data">
                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                                <thead>
                                    <tr>
                                        <th scope="col">Index No</th>
                                        <th scope="col">Trainee Name</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
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
    $(document).ready(function() {
        $(".js-example-basic-single").select2();
    });
    //Date picker
    $("#reservationdate").datetimepicker({
        format: 'YYYY/MM/DD',
    });
</script>

<script>
    $(document).ready(function() {
        $('select[name="course_id"]').on('change', function() {
            var course_id = $(this).val();
            if (course_id) {
                $.ajax({
                    url: '/marksheet/venue/' + course_id ,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var res = '<option value="">Select Venue</option>';
                        $.each(data.venues, function(key, value) {
                            res +=
                                '<option value="'+ value.id +'">'+ value.name +'</option>';
                        });
                        $('select[name="venue_id"]').html(res);
                    }

                });

            }
        });
    });

    $(document).ready(function() {
        $('select[name="venue_id"]').on('change', function() {
            var venue_id = $(this).val();

            if (venue_id) {
                $.ajax({
                    url: '/marksheet/batch/' + venue_id ,
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

    $(document).ready(function() {

        $('select[name="batch_id"]').on('change', function() {
            var batch_id = $(this).val();
            var date = $('#date').val();
            date = date.split('/').join('-');
            if (batch_id) {
                $.ajax({
                    url: '/trainner_information/' + batch_id + '/' + date,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var res = '';
                        var attendanceState = '';
                        var attendancestatus = '';
                        var already_done_0 = false;
                        var already_done_1 = false;
                        var keys = [];
                        for (var k in data.attendance) keys.push(k);
                        $.each(data.trainees, function(key, value) {
                            var state = false;
                            for (var i = 0; i < keys.length; i++) {
                                console.log(keys.length);
                                if (parseInt(value.id) == parseInt(keys[i])) {
                                    state = true;
                                    attendanceState = data.attendance[value.id];
                                    break;
                                }
                            }
                            if (state == true && attendanceState == 1) {
                                already_done_1 = true;
                            }
                            if (state == true && attendanceState == 0) {
                                already_done_0 = true;
                            }
                            var status0 = already_done_0 ? 'disabled' : '';
                            var status1 = already_done_1 ? 'disabled' : '';


                            res +=
                                '<tr>' +
                                '<td>' + value.index_no + '</td>' +
                                '<td>' + value.full_name + '</td>' +
                                '<td> <div class="btn-group" role="group" aria-label="Basic example">' +
                                '<button onClick="insert(\'' + value.index_no + '\',' + value.id + ',1)" id="' + value.index_no + '_' + value.id + '_1"  type="button" class="btn btn-success  ' + status1 + '" name="status">Present</button>' +
                                '<button onClick="insert(\'' + value.index_no + '\',' + value.id + ',0)"  id="' + value.index_no + '_' + value.id + '_0"   type="button" class="btn btn-danger ' + status0 + '" name="status">Absent</button>' +
                                '</td> </div>' +
                                '</tr>';

                            already_done_0 = false;
                            already_done_1 = false;

                        });
                        $('tbody').html(res)
                    }

                });

            }
        });
    });


    function insert(index_no, trainee_id, status) {
        var batch_id = $("#selectBatch").val();
        var user_id = $("#user_id").val();
        var date = $("#date").val();
        var button_id = '#' + index_no + '_' + trainee_id + '_' + status;
        var button_0 = '#' + index_no + '_' + trainee_id + '_' + '0';
        var button_1 = '#' + index_no + '_' + trainee_id + '_' + '1';
        if (date === '') {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Data Field Required',
                showConfirmButton: false
            });
            return;
        }
        $.ajax({
            url: "/attendanceInsert",
            method: "PUT",
            data: {
                _token: "{{ csrf_token() }}",
                batch_id: batch_id,
                trainee_id: trainee_id,
                index_no: index_no,
                user_id: user_id,
                status: status,
                date: date,
            },
            success: function(response) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: response.message,
                    showConfirmButton: false
                })

                $(button_0).removeClass('disabled', true);
                $(button_1).removeClass('disabled', true);
                $(button_id).addClass('disabled', true);
            },
            error: function(error) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Attendance Not Insert',
                    showConfirmButton: false
                })
            },
        });
    }
</script>
@endpush
