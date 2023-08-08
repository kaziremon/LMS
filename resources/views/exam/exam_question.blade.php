@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Set Exam Question</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                 <div class="d-inline p-2 text-white text-right float-right" >
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    <a href="{{ route('exam.index') }}" class="btn btn-sm btn-info"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
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
            <div class="col-md-12 col-x-12 col-sm-12">

<form action="{{route('exam.question_insert')}}" id="insertQuestion" method="POST">
    @csrf
                <input type="hidden" value="{{$exam->id}}" name="exam_id">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="subject_id">subject</label>
                                <select name="subject_id" class="js-example-basic-single form-control @error('subject_id') is-invalid @enderror" id="subject_id">
                                    <option value="">Select Your Subject</option>
                                    @foreach($subject as $sub)
                                        @php
                                        $setquestion=DB::table('set_questions')->where('subject_id',$sub->id)->where('status',1)->get();
                                        @endphp
                                        @if (!$setquestion->isEmpty())
                                        <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('subject_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="chapter_id">Select Your Chapter</label>
                                <select name="chapter_id" class="js-example-basic-single   form-control @error('chapter_id') is-invalid @enderror" id="chapter_id">

                                </select>
                                @error('chapter_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="difficult_level">Question Difficult Level</label>
                                <select name="defficult_level" class="js-example-basic-single form-control @error('defficult_level') is-invalid @enderror" id="defficult_level">
                                    <option value="">Select Difficult Leval</option>
                                    <option value="Easy">Easy</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Hard">Hard</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="chapter_id">Question</label>
                               <input type="text" id="question"  value="" name="question" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="view">

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
<script type="text/javascript">

//================subject dependance chapter===========================
    $(document).ready(function () {
        $('select[name="subject_id"]').on("change", function () {
            var subject_id = $(this).val();
            if (subject_id) {
                $.ajax({
                    url: "/get/chapter/" + subject_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="chapter_id"]').empty();
                        $('select[name="chapter_id"]').append('<option value="">'+'Select Your Chapter'+'</option>');
                        $.each(data, function (key, value) {
                            $('select[name="chapter_id"]').append('<option value="' + value.id + '">' + value.name + "</option>");
                        });

                    },
                });
            } else {
                $('select[name="chapter_id"]').empty();
            }
        });
    });


///============================Question view=====================
    // $('select[name="subject_id"]').on('change', function() {
    //         var chapter_id = $('#chapter_id').val();
    //         var subject_id = $(this).val();
    //         $.get('/exam/question/set/' + subject_id + '/' + chapter_id, function(data) {
    //             $data = $(data); // the HTML content that controller has produced
    //             $('#view').hide().html($data).fadeIn();
    //         });
    //         event.preventDefault();
    // });

    ///============================Question view=====================
    $('select[name="subject_id"],select[name="chapter_id"],select[name="defficult_level"]').on('change', function() {
            var chapter_id = $('#chapter_id').val();
            var subject_id = $('#subject_id').val();
            var defficult_level = $('#defficult_level').val();
            var question=$('#question').val();
            $.ajax({
                type: "GET",
                url: '/exam/question/set',
                data: {
                    chapter_id:chapter_id,
                    subject_id:subject_id,
                    defficult_level:defficult_level,
                    question:question
                    },
                success: function (data) {
                    $data = $(data); // the HTML content that controller has produced
                    $('#view').hide().html($data).fadeIn();
                },
                    //event.preventDefault();
            });
    });
    $('input[name="question"]').keyup(function() {
            var chapter_id = $('#chapter_id').val();
            var subject_id = $('#subject_id').val();
            var defficult_level = $('#defficult_level').val();
            var question=$('#question').val();
            $.ajax({
                type: "GET",
                url: '/exam/question/set',
                data: {
                    chapter_id:chapter_id,
                    subject_id:subject_id,
                    defficult_level:defficult_level,
                    question:question
                    },
                success: function (data) {
                    $data = $(data); // the HTML content that controller has produced
                    $('#view').hide().html($data).fadeIn();
                },
                    //event.preventDefault();
            });
    });


//////=============data insert=========================

$(document).on("click", ".insert" , function(e) {
        e.preventDefault();
    var form_data =$("#insertQuestion").serializeArray();
            var fd = new FormData();
            var other_data = form_data;
            $.each(other_data, function (key, input) {
                fd.append(input.name, input.value);
            });
        $.ajax({
        type: "POST",
        url: '/exam/question/set',
        data:fd,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire(
                'Exam?',
                'Exam Question Set!',
                'success'
            )
        },
        error:function(e){
            Swal.fire(
                'Exam?',
                'Exam Question Not Set!',
                'error'
            )
        },
    });

});
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endpush
