@extends('layouts.app') @push('css')

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
                <form class="" id="ajax-contact-form" action="{{  route('attendanceInsert') }}" method="POST">
                    @csrf
                     @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="roles">Batch Name</label>
                                <select id="selectBatch" class="js-example-basic-single form-control @error('batch_id') is-invalid @enderror" id="roles" name="batch_id">
                                    <option value="">Select Batch</option>
                                    @foreach ($batches as $e)
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
                                    <input type="text" id="date" name="date" class="form-control datetimepicker-input" data-target="#reservationdate" />
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
        format:'YYYY/MM/DD',
    });
</script>

<script>
        $(document).ready(function() {

        $('select[name="batch_id"]').on('change', function() {
        var batch_id = $(this).val();
        var date=$('#date').val();
        date=date.split('/').join('-');
        if(batch_id) {
            $.ajax({
                url: '/trainner_information/'+batch_id+ '/' +date,
                type: "GET",
                dataType: "json",
                success:function(data)
                {
                    var res='';
                    var state=false;
                    var attendanceState='';
                    var attendancestatus='';
                    var already_done_0=false;
                    var already_done_1=false;
                    var already_done_2=false;
                    var keys=[];
                    for(var k in data.attendance)keys.push(k);
                    console.log(data.attendance);
                    $.each (data.trainees, function (key, value) {
                        console.log(data.trainees);
                        for(var i = 0; i < keys.length; i++){
                            if (parseInt(value.id) == parseInt(keys[i])){
                                state=true;
                            attendanceState=data.attendance[value.id];
                            console.log(attendanceState)

                            break;
                            }
                        }
                        if(state==true && attendanceState==0){
                            already_done_0=true;
                        }
                        if(state==true && attendanceState==1){
                            already_done_1=true;
                        }
                        if(state==true && attendanceState==2)
                        {
                            already_done_2=true;
                        }
                        var status0=already_done_0 ? 'disabled' : '';
                        var status1=already_done_1 ? 'disabled' : '';
                        var status2=already_done_2 ? 'disabled' : '';

                        res +=
                            '<tr>' +
                            '<td>' + value.index_no + '</td>' +
                            '<td>' + value.full_name + '</td>' +
                            '<td> <div class="btn-group" role="group" aria-label="Basic example">' +
                                '<button onClick="insert(\''+value.index_no+'\','+value.id+',1)" id="'+value.index_no+'_'+value.id+'_1"  type="button" class="btn btn-success  '+status1+'" name="status">P</button>'+
                        '<button onClick="insert(\''+value.index_no+'\','+value.id+',0)"  id="'+value.index_no+'_'+value.id+'_0"   type="button" class="btn btn-danger '+status0+'" name="status">A</button>'+
                        '<button onClick="insert(\''+value.index_no+'\','+value.id+',2)"  id="'+value.index_no+'_'+value.id+'_2"  type="button" class="btn btn-primary '+status2+'" name="status">L</button>'+
                        '</td> </div>'+

                            '</tr>';

                    already_done_0=false;
                    already_done_1=false;
                    already_done_2=false;
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
            var button_id = '#'+index_no + '_' + trainee_id + '_' + status
            console.log(button_id)
            if(date ===''){
                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Data Field Required',
                        showConfirmButton: false
                    });
                return;
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
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: response.message,
                        showConfirmButton: false
                    })
                    $(button_id).prop('disabled', true);
                },
                error: function (error) {
                    console.log(error);
                },
            });
    }

    $("#date").on('change', function() {
        var date = $(this).val();
        console.log(date);
            $.ajax({
                url:'/getTodayDate/'+date,
                type:"GET",
                dataType:"json",
                success:function(data)
                {
                    console.log(data);
                },
                error:function(error)
                {
                    console.log(error);
                },

            });
        });
</script>
@endpush
