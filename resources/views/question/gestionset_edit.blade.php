@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Question Edit</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                 <div class="d-inline p-2 text-white text-right float-right" >
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

<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12 col-x-12 col-sm-12">
                @foreach ($setquestion as $key=>$item)
                <div class="col-md-12 col-x-12 col-sm-12" id="view">
                    <form action="{{route('question.questionset_update',$item->id)}}" method="POST" id="fromdata_{{$item->id}}">
                        @csrf @method('PUT')
                        <div class="card" id="deleteitem_remove_{{$item->id}}">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10">
                                        <label for="question">Question</label>
                                        <textarea id="queston" class="form-control" name="question" cols="30" rows="2" required>{{$item->question}}</textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="mark">Mark</label>
                                        <input type="number" value="{{$item->mark}}" id="mark" name="mark" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="difficult_level">Question Difficult Level</label>
                                        <select name="defficult_level" class="js-example-basic-single form-control @error('defficult_level') is-invalid @enderror" required>
                                            <option>Select Difficult Leval</option>
                                            <option value="Easy" {{$item->defficult_level =='Easy' ? 'selected' : ''}}>Easy</option>
                                            <option value="Medium" {{$item->defficult_level =='Medium' ? 'selected' : ''}}>Medium</option>
                                            <option value="Hard" {{$item->defficult_level =='Hard' ? 'selected' : ''}}>Hard</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @php
                            $allanswer=DB::table('question_answers')->where('setquestion_id',$item->id)->first();
                             $options=DB::table('question_mcqs')->where('setquestion_id',$item->id)->get();
                             $answers=DB::table('question_answers')
                            ->select('question_answers.id','question_mcqs.option')
                            ->join('question_mcqs','question_mcqs.id','=','question_answers.answer')
                            ->where('question_answers.setquestion_id',$item->id)
                            ->first();
                            @endphp
                            <div class="card-body">
                                @if(!$options->isEmpty())
                                <div class="row">
                                    @foreach ($options as $key=>$option)
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answer" id="" value="{{$option->id}}" {{$option->id==$allanswer->answer ? 'checked' : ''}}>
                                            <label class="form-check-label" for="">
                                                <input type="hidden" name="option[]" value="{{$option->id}}" />
                                                <input type="text" name="{{$option->id}}" value="{{$option->option}}" class="form-control" />
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="d-inline p-2 text-right text-dark" style="float: right;">
                                    @can('questionset.edit')
                                    <button onClick="insert({{$item->id}})" type="button" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Update</button>
                                    @endcan
                                    @can('questionset.destroy')
                                    <button onClick="deleteConfirmation({{$item->id}})" type="button" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt"></i> Delete</button>
                                        {{-- <a href="{{ route('question.questionset_delete',$item->id) }}" class="button btn btn-danger btn-sm m-1" data-id="{{$item->id}}"><i class="fas fa-trash-alt"></i> Delete</a> --}}
                                    @endcan
                                    </div>

                                @else
                                <label for="">Rubric</label> <br>
                                <textarea name="rubric" id="rucric" cols="30" rows="3">{{$item->rubric}}</textarea>
                                <div class="d-inline p-2 text-right text-dark" style="float: right;">
                                    @can('questionset.edit')
                                        <button onClick="insert({{$item->id}})" type="button" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Update</button>
                                        @endcan
                                        @can('questionset.destroy')
                                        <button onClick="deleteConfirmation({{$item->id}})" type="button" class="btn btn-danger btn-sm m-1"><i class="fas fa-trash-alt"></i> Delete</button>
                                        {{-- <a href="{{ route('question.questionset_delete',$item->id) }}" class="button btn btn-danger btn-sm m-1" data-id="{{$item->id}}"><i class="fas fa-trash-alt"></i> Delete</a> --}}
                                        @endcan
                                </div>

                                @endif
                            </div>
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>

<!-- /.content -->
<!-- /.content -->

@endsection @push('js')
<script type="text/javascript">
//==============delete===============================
$(document).on('click', '.buttonh', function (e) {
    if(!confirm("Do you really want to do this?")) {
       return false;
     }
    e.preventDefault();
    var id = $(this).data('id');
    var token = $("meta[name='csrf-token']").attr("content");
    //  swal({
    //         title: "Are you sure!",
    //         type: "error",
    //         confirmButtonClass: "btn-danger",
    //         confirmButtonText: "Yes!",
    //         showCancelButton: true,
    //     },
            $.ajax({
                type: "DELETE",
                url: '/all/set/question/' +id+ '/delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                    },
                success: function (data) {
                    $('#deleteitem_remove_'+id+'').remove();
                    Swal.fire(
                        'Question?',
                        'Question deleted successfully!',
                        'success'
                    );
                },
                error:function(e){
                    Swal.fire(
                        'Question?',
                        'Question Not deleted!',
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
                    url: '/all/set/question/' +id+ '/delete',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    success: function (resp) {
                        $('#deleteitem_remove_'+id+'').remove();
                        Swal.fire(
                            'Question?',
                            'Question deleted successfully!',
                            'success'
                        );
                    },
                    error: function (resp) {
                        Swal.fire(
                        'Question?',
                        'Question Not deleted!',
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

// ===================update function================
function insert(id)
{
    var from_data=$("#fromdata_"+id);
    $.ajax({
        type: "PUT",
        url: '/all/set/question/' +id+ '/update',
        "_token": "{{ csrf_token() }}",
        data:from_data.serialize(),
        success: function (data) {
            Swal.fire(
                'Question?',
                'Question Update successfully!',
                'success'
            )
        },
        error:function(e){
            Swal.fire(
                'Question?',
                'Question Not Update!',
                'error'
            )
        },
    });
}

</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endpush
