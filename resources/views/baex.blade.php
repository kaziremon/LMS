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
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h4>{{$exam->exam_title}}</h4>
                        <p>Date:{{$exam->date}}</p>
                        <p>Time:{{$exam->start_time}}-{{$exam->end_time}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    @php
                        $date1 = DateTime::createFromFormat('h:i a', $time);
                        $date2 = DateTime::createFromFormat('h:i a', $exam->start_time);
                        $date3 = DateTime::createFromFormat('h:i a', $exam->end_time);
                    @endphp
                    @if ($formate_date==$exam->date)
                    @if ($date1 >= $date2 && $date1 <= $date3)
                        <a href="{{url('exam/question',$exam->id)}}" class="small-box-footer">Get Access<i class="fas fa-arrow-circle-right"></i></a>
                        @else
                        <p class="small-box-footer" disabled>Not Access</p>
                        @endif
                    @else
                        <p class="small-box-footer" disabled>Not Access</p>
                    @endif

                </div>
            </div>
            @else
            @endif
            @endforeach
            @foreach ($submit_exam as $sex)
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-default">
                    <div class="inner">
                        <h4>{{$sex->exam->exam_title}}</h4>
                        <p>Date:{{$sex->exam->date}}</p>
                        <p>Time:{{$sex->exam->start_time}}-{{$sex->exam->end_time}}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <p class="small-box-footer" disabled style="color: #000">Already Submited</p>
                </div>
            </div>
            @endforeach
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection
