@extends('layouts.app') @push('css') @endpush @section('content')
<!-- /.content-header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Give Mark</h1>
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
                @if (isset($info->venue->name) && !empty($info->venue->name))
                    Venue Name:{{$info->venue->name}} <br>
                @else
                Venue Name <br>
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
            <div class="col-md-12 col-x-12 col-sm-12">
                <form action="{{url('exam/evaluation/mark/store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @foreach ($examsubmitdetails as $key=>$item)
                    <div id="main-container">
                        <div class="container-item">
                            <input type="hidden" value="{{$item->submitexam->exam_id}}" name="exam_id">
                            <input type="hidden" value="{{$item->submitexam->user_id}}" name="user_id">
                         <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                   <p>{{$key+1}}:{{$item->setquestion->question}}</p>
                                   <input type="hidden" value="{{$item->id}}" name="id[]">
                                </div>
                                @php
                                $answer=DB::table('submit_exam_details')
                                    ->select('submit_exam_details.answer','question_mcqs.option')
                                    ->join('question_mcqs','question_mcqs.id','=','submit_exam_details.answer')
                                    ->where('submit_exam_details.setquestion_id',$item->setquestion_id)->first();
                                @endphp
                                <div class="form-group">
                                    @if (!empty($answer))
                                    <p>Ans:{{ $answer->option}}</p>
                                    @else
                                    <p>Ans:{{$item->answer}}</p>
                                    @endif
                                </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="main_mark">
                                    <p> @isset($item->submitexam->exam->id)

                                        @php
                                            $examquestion=DB::table('exam_questions')
                                            ->where('exam_id',$item->submitexam->exam->id)
                                            ->where('setquestion_id',$item->setquestion_id)
                                            ->first();
                                            $sum=DB::table('exam_questions')
                                            ->where('exam_id',$item->submitexam->exam->id)
                                            ->where('status',1)
                                            ->sum('mark');

                                        @endphp
                                        Question Mark:{{$examquestion->mark}}
                                        <input type="hidden" value="{{$sum}}" name="total_mark">
                                    @endisset</p>
                                  </div>
                                  <div class="form-group">
                                      <label for="mark">Give Your Mark</label>
                                      <input type="number" class="form-control" name="mark[]" required value="{{$item->mark}}">
                                  </div>
                              </div>
                         </div>
                        </div>
                    </div>
                    <hr>
                @endforeach

                
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-edit"></i> Update</button>
                </div>
              
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection 
  @push('js')
@endpush
