@extends('layouts.app') @push('css')
<style>
    .error {
        color: #ff0000;
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
                    {{-- @can('attendance.index')
                    <li class="breadcrumb-item"><a href="{{ route('attendance.index') }}">Back</a></li>
                    @endcan --}}
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
                <form class="" id="ajax-contact-form" action="{{ isset($attendance) ? route('attendance.update',$attendance->id) : route('attendance.store') }}" method="POST">
                    @csrf @isset($attendance) @method('PUT') @endisset

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="roles">Batch Name</label>
                                <select id="selectBatch" class="js-example-basic-single form-control @error('batch_id') is-invalid @enderror" id="roles"  name="batch_id">
                                    <option value="">Select Batch</option>
                                    @foreach ($batchs as $e)
                                    <option value="{{ $e->id }}" @isset($attendance) {{ $e->id==$attendance->batch_id ?'selected' : '' }} @endif>{{ $e->name }}</option>
                                    @endforeach
                                </select>
                                <span id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Date:</label>
                                <div class="date input-group" id="reservationdate" data-target-input="nearest">
                                    <input type="text" id="date" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <span id="dateerroremessage"></span>
                        </div>
                        <div class="col-md-12 col-x-12 col-sm-12">
                            <table id="example1" class="table table-bordered attendance_data">
                               <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                                <thead>
                                    <tr>
                                        <th scope="col">Index No</th>
                                        <th scope="col">Trainer Name</th>
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
    $(document).ready(function () {
        $(".js-example-basic-single").select2();
    });
    //Date picker
    $("#reservationdate").datetimepicker({
        format: "L",
    });
</script>

<script>
        $(document).ready(function() {

        $('select[name="batch_id"]').on('change', function() {
        var batch_id = $(this).val();
        if(batch_id) {
            $.ajax({
                url: '/trainner_information/'+batch_id,
                type: "GET",
                dataType: "json",
                success:function(data)
                {
                    var res='';
                    $.each (data, function (key, value) {
                    res +=
                    '<tr>'+
                        '<td>'+value.index_no+'</td>'+
                        '<td>'+value.trainee_name+'</td>'+
                        '<td> <div class="btn-group" role="group" aria-label="Basic example">'+
                        '<button onClick="insert(\''+value.index_no+'\','+value.id+',1)" value="1" id="status" type="button" class="btn btn-success attandanceinsert" name="status">P</button>'+
                        '<button onClick="insert(\''+value.index_no+'\','+value.id+',0)" value="0" id="status" type="button" class="btn btn-success attandanceinsert" name="status">A</button>'+
                        '<button onClick="insert(\''+value.index_no+'\','+value.id+',2)" value="2" id="status" type="button" class="btn btn-success attandanceinsert" name="status">L</button>'+
                        '</td> </div>'+
                    '</tr>';
                });
                    $('tbody').html(res)
            }

            });

        }
    });

    });


    function insert(index_no,trainee_id,status)
    {
            var batch_id = $("#selectBatch").val();
            var user_id = $("#user_id").val();
            var date = $("#date").val();
            if(date ===''){
                alert("Please Inter your Date");
                return
            }
            $.ajax({
                url: "/attendance",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    batch_id: batch_id,
                    trainee_id: trainee_id,
                    index_no: index_no,
                    user_id: user_id,
                    status: status,
                    date: date,
                },
                success: function (response) {
                    console.log(response);

                },
                error: function (error) {
                    console.log(error);
                },
            });
    }

</script>
@endpush
