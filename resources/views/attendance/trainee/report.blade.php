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
                    <form class="" id="FilterForm" action="{{route('trainee_report') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="row">
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
