@extends('layouts.app') @push('css') @endpush @section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
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
<!-- /.content-header -->
<div class="container">
    <div class="col-md-12 text-center">
         <div class="">
            @if (isset($info->exam->exam_title) && !empty($info->exam->exam_title))
            <h2><strong>{{$info->exam->exam_title}}</strong></h2>
            @else
                <h2> <strong>Title</strong> </h2>
            @endif

            <p class="lead mb-5">
            {{-- @foreach ($questions as $key=>$item)
                @if (isset($item->subject->title) && !empty($item->subject->title))
                   <span>{{$item->subject->title}}</span>,
                @else

                @endif
            @endforeach
            <br>
            @foreach ($questions as $key=>$item)
                @if (isset($item->chapter->name) && !empty($item->chapter->name))
                <span> {{$item->chapter->name}}</span>,
                @else

                @endif
                @endforeach --}}
                {{-- @if (isset($details->user->name) && !empty($details->user->name))
                    Question Made By <strong>{{$details->user->name}}</strong>
                @else
                Question Made By Admin
                @endif --}}

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
                <form action="{{route('exam_submit.store')}}" method="POST" id="fromdata" class="from-hiden">
                    @csrf
                <input type="hidden" name="exam_id" value="{{$info->exam_id}}" class="form-control">
                @foreach ($questions as $key=>$item)
                <div class="jumbotron">
                    <input type="hidden" name="question[]" value="{{$item->setquestion_id}}" class="form-control">
                    <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">{{$key+1}}. {{$item->setquestion->question}}</div>
                    <div class="d-inline p-2 text-right text-dark" style="float: right"><p>{{$item->mark}}</p></div>
                    <hr class="my-4" />
                     @php
                    $allanswer=DB::table('question_answers')->where('setquestion_id',$item->setquestion->id)->first();
                         $options=DB::table('question_mcqs')->where('setquestion_id',$item->setquestion->id)->get();
                         $answers=DB::table('question_answers')
                         ->select('question_answers.id','question_mcqs.option')
                         ->join('question_mcqs','question_mcqs.id','=','question_answers.answer')
                         ->where('question_answers.setquestion_id',$item->setquestion->id)
                         ->first();
                         $finishTime = \Carbon\Carbon::parse($item->exam->end_time)->format('h:i A');
                         $ty1=\Carbon\Carbon::parse($finishTime)->diffInSeconds($time);
                         $cal=$ty1*1000;
                     @endphp
                    <input type="hidden" class="form-control" value="{{ $cal}}" data-time="{{$cal}}" id="time">
                     @if(!$options->isEmpty())
                    @foreach($options as $key=>$option)
                    <div class="form-check">
                        <input class="form-check-input" value="{{$option->id}}" type="radio" name="radio_{{$option->setquestion_id}}" id="{{$option->id}}">
                        <label class="form-check-label" for="{{$option->id}}">
                            {{$option->option}}
                        </label>
                    </div>
                    @endforeach
                    @else
                    <div class="form-group">
                        <label for="answer">Answer</label>
                        <textarea id="" name="answer[]" rows="7" cols="5" class="form-control @error('answer') is-invalid @enderror"></textarea>
                        @error('answer')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif
                </div>
                @endforeach
                <input type="submit" value="Submit" class="btn btn-success btn-sm">
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

<script>
    let time = $('#time').val();
    setTimeout(function() {
        $("form.from-hiden").submit(function(e) {
            var from_data=$("#fromdata");
            e.preventDefault();
            $.ajax({
            url: 'auto/submit',
            "_token": "{{ csrf_token() }}",
            type: "POST",
            data:from_data.serialize(),
            success: function (data) {

                Swal.fire(
                'Exam?',
                'Exam Submit successfully!',
                'success'
             )
             window.location=data.url;
            },
            error:function(e){
                Swal.fire(
                'Exam?',
                'Exam Submit Not successfully!',
                'error'
                )
            },
            });
        });
        $("form.from-hiden").submit();
    }, time);
</script>
@endpush
