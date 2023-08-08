@extends('layouts.app')
@push('css')
<style>
    @media print {
  .noprint {
    visibility: hidden;
  }
}
    </style>
@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark" style="font-weight: bold">Question Preview</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                 <div class="d-inline p-2 text-white text-right float-right" >
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    <a href="{{ route('exam.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <button onclick="myFunction()" class="btn btn-success btn-sm m-1 noprint"><i class="fa fa-print" aria-hidden="true"></i> Print</button>

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
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12" style="text-align: center">
            @isset($examquestiondetails->exam->exam_title)
                <h3 class="font-weight-bold">Exam Title:{{$examquestiondetails->exam->exam_title}}</h3>
            @endisset
            @isset($examquestiondetails->exam->course->title)
            <p class="font-weight-bold">Course:{{$examquestiondetails->exam->course->title}}</p>
            @endisset
            @isset($examquestiondetails->exam->venue->name)
            <p class="font-weight-bold">Venue:{{$examquestiondetails->exam->venue->name}}</p>
            @endisset
            @isset($examquestiondetails->exam->batch->name)
            <p class="font-weight-bold">Batch:{{$examquestiondetails->exam->batch->name}}</p>
            @endisset
        </div>
    </div>
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12 col-x-12 col-sm-12">
                <form action="{{route('exam_question_privew.update')}}" method="POST" id="fromdata">
                @csrf
                @foreach ($examquestion as $key=>$item)
                    <input type="hidden" value="{{$item->id}}" name="id[]">
                    <div class="card" id="deleteitem_remove_{{$item->id}}">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-11">
                                    {{$key+1}}. {{$item->setquestion->question}}
                                </div>
                                <div class="col-md-1">
                                   {{$item->mark}}
                                </div>
                            </div>
                        </div>
                        @php
                         $allanswer=DB::table('question_answers')->where('setquestion_id',$item->setquestion->id)->first();
                         $options=DB::table('question_mcqs')->where('setquestion_id',$item->setquestion->id)->get();
                         $answers=DB::table('question_answers')
                         ->select('question_answers.id','question_mcqs.option')
                         ->join('question_mcqs','question_mcqs.id','=','question_answers.answer')
                         ->where('question_answers.setquestion_id',$item->setquestion->id)
                         ->first();
                        @endphp
                        <div class="card-body">
                          @if(!$options->isEmpty())
                            @foreach ($options as $key=>$option)
                                    <div class="col-md-12">
                                        {{$key+1}}. {{$option->option}}
                                    </div>
                            @endforeach
                            @if(isset($answers->option))
                                Answer: {{ $answers->option}}
                            @endif

                            @if($examquestiondetails->exam->status==0)
                                <div class="d-inline p-2 text-right text-dark" style="float: right"><p>
                                    <button onClick="deleteConfirmation({{$item->id}})" type="button" class="btn btn-danger noprint btn-sm m-1"><i class="fas fa-trash-alt"></i> Delete</button>
                                </div>
                            @else
                            @endif

                            @else
                            @if($examquestiondetails->exam->status==0)
                            <div class="d-inline p-2 text-right text-dark" style="float: right"><p>
                                <button onClick="deleteConfirmation({{$item->id}})" type="button" class="btn btn-danger noprint btn-sm m-1"><i class="fas fa-trash-alt"></i> Delete</button>
                            </div>
                            @else
                            @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </form>
            </div>
            <div class="col-md-4"></div>
            @if($examquestiondetails->exam->status==0)
            <div class="col-md-4">
                <button type="button" class="btn btn-primary noprint btn-lg btn-block statusupdate"><i class="fas fa-edit"></i> Question Final</button>
            </div>
            @else
            @endif
            <div class="col-md-4"></div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>

<!-- /.content -->

@endsection @push('js')

<script>
     function myFunction() {
      window.print();
    }
</script>
<script type="text/javascript">
//==============delete===============================
$(document).on('click', '.button', function (e) {
    if(!confirm("Do you really want to do this?")) {
       return false;
     }
    e.preventDefault();
    var id = $(this).data('id');
    var token = $("meta[name='csrf-token']").attr("content");
            $.ajax({
                type: "DELETE",
                url: '/exam/question/' +id+ '/preview/delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                    },
                success: function (data) {
                    $('#deleteitem_remove_'+id+'').remove();
                    Swal.fire(
                        'Question?',
                        'Exam Question deleted successfully!',
                        'success'
                    );
                },
                error:function(e){
                    Swal.fire(
                        'Question?',
                        'Exam Question Not deleted!',
                        'error'
                    )
                },
            });
});

//==========try=================================
function deleteConfirmation(id) {
        swal.fire({
            title: "Delete?",
            icon: 'question',
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                $.ajax({
                    type: "DELETE",
                    url: '/exam/question/' +id+ '/preview/delete',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    success: function (resp) {
                        $('#deleteitem_remove_'+id+'').remove();
                        Swal.fire(
                            'Question?',
                            'Exam Question deleted successfully!',
                            'success'
                        );
                    },
                    error: function (resp) {
                        Swal.fire(
                        'Question?',
                        'Exam Question not deleted successfully!',
                        'error'
                        )
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
}
function update()
{
    var from_data=$("#fromdata");
    console.log(from_data);
    $.ajax({
        type: "PUT",
        url: '/exam/question/preview/update',
        "_token": "{{ csrf_token() }}",
        data:from_data.serialize(),
        success: function (data) {
            Swal.fire(
                'Question?',
                'Question Status Updated successfully!',
                'success'
            )
        },
        error:function(e){
            Swal.fire(
                'Question?',
                'Question Status Not Updated!',
                'error'
            )
        },
    });
}
$(document).on("click", ".statusupdate" , function(e) {
        e.preventDefault();
    var form_data =$("#fromdata").serializeArray();
            var fd = new FormData();
            var other_data = form_data;
            $.each(other_data, function (key, input) {
                fd.append(input.name, input.value);
            });
        $.ajax({
        type: "POST",
        url: '/exam/question/preview/update',
        data:fd,
        processData: false,
        contentType: false,
        success: function (data) {
            Swal.fire(
                'Question?',
                'Question Status Updated successfully!',
                'success'
            )
            window.location.href =data.url;
        },
        error:function(e){
            Swal.fire(
                'Question?',
                'Question Status Not Updated!',
                'error'
            )
        },
    });

});
</script>



@endpush
