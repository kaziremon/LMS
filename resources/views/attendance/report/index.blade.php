@extends('layouts.app') @push('css')
    <link rel="stylesheet" href="{{asset('css/report.css')}}">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th {
            font-size: 13px;
            text-align: left;
            padding-left: 5px;
        }

        table,
        td {
            font-size: 13px;
            text-align: left;
            padding-left: 5px;
        }

        thead {
            /* background: none; */
            color: black;
        }

        .foright {
            text-align: right;
        }

        h4 h5 {
            margin-bottom: 0;
        }

        hr {
            width: 160px;
            float: right;
            border-top: 1px solid #212529 !important;
        }
    </style>
@endpush
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Attendance Report</h4>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Attendance Report</li>
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
                    <form class="" id="FilterForm" action="{{route('report.form') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-md-4 col-xs-6 col-sm-4">
                                <div class="form-group">
                                    <label for="course">Course Name</label>
                                    <select id="selectCourse"
                                            class="searchable_select form-control @error('course_id') is-invalid @enderror"
                                            name="course_id">
                                        <option value="0">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6 col-sm-4">
                                <div class="form-group">
                                    <label for="venue">Venue Name</label>
                                    <select id="selectVenue"
                                            class="searchable_select form-control @error('venue_id') is-invalid @enderror"
                                            name="venue_id">
                                        <option value="0">Select Venue</option>

                                    </select>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6 col-sm-4">
                                <div class="form-group">
                                    <label for="roles">Batch Name</label>
                                    <select id="selectBatch"
                                            class="searchable_select form-control @error('batch_id') is-invalid @enderror"
                                            name="batch_id">
                                        <option value="0">Select Batch</option>
                                    </select>
                                    <span id="error"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6 col-sm-4">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="date input-group" id="reservationdate" data-target-input="nearest">
                                        <input type="text" id="start_date" name="start_date"
                                               class="form-control datetimepicker-input"
                                               data-target="#reservationdate"/>
                                        <div class="input-group-append" data-target="#reservationdate"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <span id="dateerroremessage"></span>
                            </div>
                            <div class="col-md-4 col-xs-6 col-sm-4">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="date input-group" id="reserenddateend" data-target-input="nearest">
                                        <input type="text" id="end_date" name="end_date"
                                               class="form-control datetimepicker-input"
                                               data-target="#reserenddateend"/>
                                        <div class="input-group-append" data-target="#reserenddateend"
                                             data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <span id="dateerroremessage"></span>
                            </div>
                            <div class="col-md-4 col-xs-6 col-sm-4">
                                <button type="submit" class="btn btn-success" style="margin-top:32px">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div id="formdata" style="background-color: #FFFFFF;"></div>
        </div>
        <!-- /.row (main row) -->

        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection @push('js')
    <script>
        $(document).ready(function () {
            $("#FilterForm").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    //   url: '/report/form',
                    data: $(this).serialize(), // serializes the form's elements.
                    beforeSend: function () {
                        // $('#wait').show();
                    },
                    success: function (data) {

                        $("#formdata").html(data);
                    },
                    error: function (err) {
                        //  $('#wait').hide();
                    },
                    complete: function () {
                        // $('#wait').hide();
                    }
                });
            });

            $('select[name="course_id"]').on('change', function () {
                var course_id = $(this).val();
                if (course_id) {
                    $.ajax({
                        url: '/marksheet/venue/' + course_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var res = '<option value="0">Select Venue</option>';
                            $.each(data.venues, function (key, value) {
                                res +=
                                    '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $('select[name="venue_id"]').html(res);
                        }

                    });

                }
            });
            $('select[name="venue_id"]').on('change', function () {
                var venue_id = $(this).val();

                if (venue_id) {
                    $.ajax({
                        url: '/marksheet/batch/' + venue_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            var res = '<option value="0">Select Batch</option>';
                            $.each(data.batches, function (key, value) {
                                res +=
                                    '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $('select[name="batch_id"]').html(res);
                        }

                    });

                }
            });
            //Date picker
            $("#reserenddateend").datetimepicker({
                format: 'YYYY/MM/DD',
            });
            $("#reservationdate").datetimepicker({
                format: 'YYYY/MM/DD',
            });
        });
    </script>

@endpush
