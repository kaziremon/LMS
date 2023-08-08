@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Question Review</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                 <div class="d-inline p-2 text-white text-right float-right" >
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-success text-right" ><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    {{-- <a href="{{ route('question.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a> --}}
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
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label for="subject_id">Subject</label>
                                <select name="subject_id" class="js-example-basic-single form-control @error('subject_id') is-invalid @enderror" id="subject_id">
                                    <option>Select Your Subject</option>
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
                                <select name="chapter_id" class="js-example-basic-single form-control @error('chapter_id') is-invalid @enderror" id="chapter_id">

                                </select>
                                @error('chapter_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="view">

                    </div>

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
                    url: "{{ route('get-chapter') }}",
                    type: "GET",
                    data:{
                        subject_id: subject_id
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $('select[name="chapter_id"]').empty();
                        $.each(data, function(key, value) {
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
    $('select[name="chapter_id"]').on('change', function() {
            var chapter_id = $(this).val();
            var subject_id = $('#subject_id').val();
            $.get('/admin/question/review/' + subject_id + '/' + chapter_id, function(data) {
                $data = $(data);
                $('#view').hide().html($data).fadeIn();
            });
            event.preventDefault();
        });

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
                url: '/question/review/' +id+ '/delete',
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

//==============delete sweet alart
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
                    url: '/question/review/' +id+ '/delete',
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
////================================Update=============================
function insert(id)
{
    var from_data=$("#fromdata_"+id);
    $.ajax({
        type: "PUT",
        url: '/question/review/' +id+ '/update',
        "_token": "{{ csrf_token() }}",
        data:from_data.serialize(),
        success: function (data) {
            Swal.fire(
                'Question?',
                'Question Updated successfully!',
                'success'
            )
        },
        error:function(e){
            Swal.fire(
                'Question?',
                'Question Not Updated!',
                'error'
            )
        },
    });
}



//==============Status Update===============================
$(document).on('click', '.status_update', function (e) {
    if(!confirm("Do you really want to do this?")) {
       return false;
     }
    e.preventDefault();
    var id = $(this).data('id');
    console.log(id);

            $.ajax({
                type: "PUT",
                url: 'status/' +id+ '/update',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id:id
                    },
                success: function (data) {
                    $('#deleteitem_remove_'+id+'').remove();
                    Swal.fire(
                        'Question?',
                        'Question Save To Question Bank successfully!',
                        'success'
                    );
                },
                error:function(e){
                    Swal.fire(
                        'Question?',
                        'Question Not  Save To Question Bank!',
                        'error'
                    )
                },
            });


});






//////////========save to question bank====================

function savetoquestionbank(id) {
        swal.fire({
            title: "Save To Question Bank?",
            icon: 'question',
            text: "Please ensure and then confirm!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, Do it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                $.ajax({
                    type: "PUT",
                    url: '/question/review/status/' +id+ '/update',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id:id
                    },
                    success: function (resp) {
                        $('#deleteitem_remove_'+id+'').remove();
                        Swal.fire(
                        'Question?',
                        'Question Save To Question Bank successfully!',
                        'success'
                        );
                    },
                    error: function (resp) {
                        Swal.fire(
                        'Question?',
                        'Question Not  Save To Question Bank!',
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
</script>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
