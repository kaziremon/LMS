@extends('layouts.app') @push('css') @endpush @section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Writen Question Create</div> --}}
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
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12 text-center">
                @if (isset($question->chapter->questionbank->title))
                    <h2>{{$question->chapter->questionbank->title}}</h2>
                @else
                <h2></h2>
                @endif
                @if (isset($question->chapter->name))
                <h4>{{$question->chapter->name}}</h4>
                @else
                <h4></h4>
                @endif
                @if (isset($question->examtype->name))
                <h5>{{$question->examtype->name}}</h5>
                @else
                <h4></h4>
                @endif
                @if (isset($question->user->name))
                <p>Made By:{{$question->user->name}}</p>
                @else
                <p></p>
                @endif
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12 col-x-12 col-sm-12">
                <form action="{{route('question.writen_store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <div id="main-container">
                        <div class="container-item">
                         <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label" for="">Question</label>
                                    <textarea id="summernote" class="form-control" name="question[]"  cols="30" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="mark">Mark</label>
                                    <input type="number" class="form-control" name="mark[]" required>
                                </div>
                                <div class="form-group">
                                    <label for="difficult_level">Question Difficult Level</label>
                                    <select name="defficult_level[]" class="form-control @error('defficult_level') is-invalid @enderror" required>
                                        <option>Select Difficult Leval</option>
                                        <option value="Easy">Easy</option>
                                        <option value="Medium">Medium</option>
                                        <option value="Hard">Hard</option>

                                    </select>
                                    @error('defficult_level[]')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                              </div>
                              <div class="col-md-4">
                                  <div class="form-group">
                                    <label class="control-label" for="">Rubrics</label>
                                    <textarea id="summernote" class="form-control" name="rubric[]"  cols="30" rows="6"></textarea>
                                </div>
                              </div>

                         </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div>
                                        <a href="javascript:void(0)" class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <div class="">
                        <div>
                            <a class="btn btn-success btn-sm" id="add-more" href="javascript:;" role="button"><i class="fa fa-plus"></i> Add More Row</a>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
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

<script src="{{asset('js/cloneData.js')}}" type="text/javascript"></script>
<script>

    let i=1;
    $("a#add-more").cloneData({
        mainContainerId: "main-container", // Main container Should be ID
        cloneContainer: "container-item", // Which you want to clone
        removeButtonClass: "remove-item", // Remove button for remove cloned HTML
        removeConfirm: true, // default true confirm before delete clone item
        removeConfirmMessage: "Are you sure want to delete?", // confirm delete message
        //append: '<a href="javascript:void(0)" class="remove-item btn btn-sm btn-danger remove-social-media">Remove</a>', // Set extra HTML append to clone HTML
        minLimit: 1, // Default 1 set minimum clone HTML required
        maxLimit: 50, // Default unlimited or set maximum limit of clone HTML
        defaultRender: 1,
        init: function () {
            console.info();
        },
        beforeRender: function () {

            console.info();
        },
        afterRender: function () {
            console.info("");
            //$(".selectpicker").selectpicker('refresh');
        },
        afterRemove: function () {
            console.warn("");
        },
        beforeRemove: function () {
            console.warn("");
        },
    });
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>
@endpush
