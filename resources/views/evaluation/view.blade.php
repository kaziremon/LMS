@extends('layouts.app') @push('css') @endpush @section('content')
<!-- /.content-header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"></h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <div class="d-inline-right p-2 text-white text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-success text-right" >Back</a>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<div class="container">
    <div class="col-md-12 text-center">
        <div class="">
                <h2> <strong>{{$info->exam_title}}</strong> </h2>
            <p class="lead mb-5">
                @if (isset($info->course->title) && !empty($info->course->title))
                  Course Name: {{$info->course->title}}<br>
                @else
                    Course Name <br>
                @endif
                @if (isset($info->batch->name) && !empty($info->batch->name))
                    Batch Name:{{$info->batch->name}} <br>
                @else
                   Venue Name <br>
                @endif
            </p>
        </div>
    </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            @foreach ($examsubmitdetails as $key=>$item)
            <div class="col-md-12 col-x-12 col-sm-12">
                <div class="jumbotron">
                    <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">{{$key+1}}.{{$item->setquestion->question}}</div>
                    <div class="d-inline p-2 text-right text-dark" style="float: right"><p>{{$item->mark}}</p></div>
                    <hr class="my-4" />
                     @php
                        $answer=DB::table('submit_exam_details')
                            ->select('submit_exam_details.answer','question_mcqs.option')
                            ->join('question_mcqs','question_mcqs.id','=','submit_exam_details.answer')
                            ->where('submit_exam_details.setquestion_id',$item->setquestion_id)->first();
                    @endphp
                      @if (!empty($answer))
                    	<p>Ans:{{ $answer->option}}</p>
                      @else
			            <p>Ans:{{ $item->answer}}</p>
                      @endif
                </div>

            </div>
            @endforeach
        </div>
        {{$examsubmitdetails}}
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js')
@endpush
