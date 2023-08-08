@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0 text-dark">Question Create</h1>
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
            <div class="col-md-12 col-x-12 col-sm-12">
                <form action="{{route('question.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="subject_id">Subject</label>
                        <select name="subject_id" class="js-example-basic-single form-control @error('subject_id') is-invalid @enderror" id="subject_id">
                            <option>Select Your Subject</option>
                            @foreach($subject as $sub)
                            <option value="{{ $sub->id }}">{{ $sub->title }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="chapter_id">Chapter</label>
                        <select name="chapter_id" class="js-example-basic-single form-control @error('chapter_id') is-invalid @enderror">
                            
                        </select>
                        @error('chapter_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="questiontype_id">Exam Type</label>
                        <select name="questiontype_id" class="js-example-basic-single form-control @error('questiontype_id') is-invalid @enderror">
                            <option>Select Question Type</option>
                            @foreach($examtype as $ex)
                            <option value="{{ $ex->id }}">{{ $ex->name }}</option>
                            @endforeach
                        </select>
                        @error('questiontype_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <br>
                    <input type="submit" class="btn btn-success" value="Create" />
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
    $(document).ready(function() {
        $('select[name="subject_id"]').on("change", function() {
            alert("aaa");
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
</script>
<script>
    $(document).ready(function() {
        // $('.js-example-basic-single').select2();
    });
</script>


@endpush
