@extends('layouts.app') @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-11">
                <h1 class="m-0 text-dark">Exam List</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-1">
                <div class="d-inline p-2 text-white text-right">
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
            @foreach ($exams as $exam)
            @php
                $submitexam=DB::table('submit_exams')
                            ->where('exam_id',$exam->id)
                            ->where('user_id',Auth::user()->id)
                            ->first();
            @endphp
            @if(empty($submitexam))
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-uppercase mb-1">{{$exam->exam_title}}</div>
                                <div class="text-xs mb-0 mr-3 font-weight-bold text-gray-800">Date:{{$exam->date}}</div>
                                <div class="text-xs mb-0 mr-3 font-weight-bold text-gray-800">Time:{{$exam->start_time}}-{{$exam->end_time}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                             @php
                                $date1 = DateTime::createFromFormat('h:i a', $time);
                                $date2 = DateTime::createFromFormat('h:i a', $exam->start_time);
                                $date3 = DateTime::createFromFormat('h:i a', $exam->end_time);
                            @endphp
                             @if ($formate_date==$exam->date)
                                @if ($date1 >= $date2 && $date1 <= $date3)
                                     <div class="h5 font-weight-bold text-uppercase mb-1"> <a href="{{url('exam/question',$exam->id)}}">Get Access<i class="fas fa-arrow-circle-right"></i></a></div>
                                @else
                                      <div class="text-xs font-weight-bold text-uppercase mb-1">Not Access</div>
                                @endif
                                @else
                                    
                                     <div class="text-xs font-weight-bold text-uppercase mb-1">Not Access</div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            @else
            @endif
            @endforeach
            @foreach ($submit_exam as $sex)
             <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h5 font-weight-bold text-uppercase mb-1">{{$sex->exam->exam_title}}</div>
                                <div class="text-xs mb-0 mr-3 font-weight-bold text-gray-800">Date:{{$sex->exam->date}}</div>
                                <div class="text-xs mb-0 mr-3 font-weight-bold text-gray-800">Time:{{$sex->exam->start_time}}-{{$sex->exam->end_time}}</div>
                            </div>
                            <div class="col-auto">
                               <i class="ion ion-pie-graph"></i>
                            </div>
                            <div class="h5 font-weight-bold text-uppercase mb-1">Already Submited</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
