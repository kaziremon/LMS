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
<div class="container">
    <div class="col-md-12 text-center">
        <div class="">
            @if (isset($details->questionbank->title) && !empty($details->questionbank->title))
            <h2><strong>{{$details->questionbank->title}}</strong></h2>
            @else
                <h2> <strong>Title</strong> </h2>
            @endif
            
            <p class="lead mb-5">
                @if (isset($details->topictypes->title) && !empty($details->topictypes->title))
                   {{$details->topictypes->title}}<br>
                @else
                    Topic Title <br>
                @endif   
                @if (isset($details->examtype->name) && !empty($details->examtype->name))
                {{$details->examtype->name}} <br>
                @else
                    Exam Types Null <br>
                @endif
                @if (isset($details->user->name) && !empty($details->user->name))
                    Question Made By <strong>{{$details->user->name}}</strong>
                @else
                Question Made By Admin
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
                @foreach ($QuestionBankQuestions as $key=>$item)
                    <div class="card">
                        <div class="card-header">
                            <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">{{$key+1}}.{{$item->question}}</div> 
                          
                           <div class="d-inline p-2 text-right text-dark" style="float: right"><p>{{$item->mark}}</p></div>
                        </div>
                        @php
                         $allanswer=DB::table('question_bank_answers')->where('questionBankQuestion_id',$item->id)->get();
                         $options=DB::table('question_bank_mcqs')->where('questionBankQuestion_id',$item->id)->get();
                         $answers=DB::table('question_bank_answers')
                         ->select('question_bank_answers.id','question_bank_mcqs.option')
                         ->join('question_bank_mcqs','question_bank_mcqs.id','=','question_bank_answers.answer')
                         ->where('question_bank_answers.questionBankQuestion_id',$item->id)
                         ->get();
                        @endphp
                        <div class="card-body">
                          @if(!$options->isEmpty())
                            @foreach ($options as $key=>$option)
                            <p>{{$key+1}}.{{$option->option}}</p>
                            @endforeach
                            @foreach ($answers as $answer)
                            <p></p>
                            <div class="d-inline p-2  text-dark" style="font-size: 16px;font-weight: bold">Ans:{{$answer->option}}</div> 
                            <div class="d-inline p-2 text-right text-dark" style="float: right"><p>
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $item->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                <form id="delete-form-{{$item->id}}" action="{{route('questionbankquestion.destroy',$item->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>    
                            </p></div>
                            @endforeach
                            @else 
                            @foreach ($allanswer as $asn)
                            <div class="d-inline p-2  text-dark" style="font-size: 16px;font-weight: bold">Ans:{{$asn->answer}}</div> 
                            <div class="d-inline p-2 text-right text-dark" style="float: right"><p>
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $item->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                <form id="delete-form-{{$item->id}}" action="{{route('questionbankquestion.destroy',$item->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>    
                            </p></div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js')


@endpush
