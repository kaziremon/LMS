@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Question Preview</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                <div class="d-inline p-2 text-white text-right float-right">
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    <a href="{{ route('question.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
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
        <!-- Main row -->
        <div class="row">
            @foreach ($setquestion as $key=>$item)
            <div class="col-md-12 col-x-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-11">
                               {{$key+1}}. {{$item->question}}
                            </div>
                            <div class="col-md-1">
                                {{$item->mark}}
                            </div>
                        </div>
                    </div>
                    @php
                        $allanswer=DB::table('question_answers')->where('setquestion_id',$item->id)->first();
                        $options=DB::table('question_mcqs')->where('setquestion_id',$item->id)->get();
                        $answers=DB::table('question_answers')
                        ->select('question_answers.id','question_mcqs.option')
                        ->join('question_mcqs','question_mcqs.id','=','question_answers.answer')
                        ->where('question_answers.setquestion_id',$item->id)->first();
                    @endphp
                    <div class="card-body">
                        @if(!$options->isEmpty())
                        @foreach ($options as $key=>$option)
                        <div class="col-md-12">
                            {{$key+1}}.{{$option->option}}
                        </div>
                        @endforeach
                        @if (isset($answers->option))
                        Answer:{{ $answers->option}}
                        @endif
                        @else
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- /.row (main row) -->
</section>

<!-- /.content -->

@endsection @push('js')
<script type="text/javascript"></script>
@endpush
