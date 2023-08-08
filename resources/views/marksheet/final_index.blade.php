@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Final Marksheet</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Final Marksheet</li>
                </ol>
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
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label for="course">Course Name</label>
                                <select id="selectCourse" class="js-example-basic-single form-control @error('course_id') is-invalid @enderror" name="course_id">
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                <span id="error"></span>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label for="venue">Venue Name</label>
                                <select id="selectVenue" class="js-example-basic-single form-control @error('venue_id') is-invalid @enderror" name="venue_id">
                                    

                                </select>
                                <span id="error"></span>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label for="batch">Batch Name</label>
                                <select id="selectBatch" class="js-example-basic-single form-control @error('batch_id') is-invalid @enderror" name=" batch_id " >
                                    
                                    
                                </select>
                                <span id="error"></span>
                            </div>
                        <!-- </div>
                        @can('marksheet.trainee_result')
                        <div class="col-md-3 col-xs-6 col-sm-3">
                            <div class="form-group">
                                <label for="trainee">Trainee Name</label>
                                <select id="selectTrainee" class="js-example-basic-single form-control @error('trainee_id') is-invalid @enderror" name="trainee_id">
                                    
                                    
                                </select>
                                <span id="error"></span>
                            </div>
                        </div>
                        @endcan -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row (main row) -->
        <div id="view" class="form-group clearfix" style="background-color:#ffffff;">
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection 
@push('js')


<script>
    $(document).ready(function() {
        $(".js-example-basic-single").select2();
    });

    $(document).ready(function() {
        var checkedValues = $("input:checkbox:checked", "#table1").map(function() {
            return $(this).val();
        }).get();
        console.log(checkedValues.join(','));
    });
</script>

<script>
    $(document).ready(function() {
        $('select[name="course_id"]').on('change', function() {
            var course_id = $(this).val();
            if (course_id) {
                $.ajax({
                    url: '/marksheet/venue/' + course_id ,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var res = '<option value="">Select Venue</option>';
                        $.each(data.venues, function(key, value) {
                            res +=
                                '<option value="'+ value.id +'">'+ value.name +'</option>';
                        });
                        $('select[name="venue_id"]').html(res);
                    }

                });

            }
        });
    });

    $(document).ready(function() {
        $('select[name="venue_id"]').on('change', function() {
            var venue_id = $(this).val();
            
            if (venue_id) {
                $.ajax({
                    url: '/marksheet/batch/' + venue_id ,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var res = '<option value="">Select Batch</option>';
                        $.each(data.batches, function(key, value) {
                            res +=
                                '<option value="'+ value.id +'">'+ value.name +'</option>';
                        });
                        $('select[id="selectBatch"]').html(res);
                    }

                });

            }
        });
    });

    $(document).ready(function() {
        $('select[name=" batch_id "]').on('change', function() {
            let batch_id = $(this).val();
            $.get('/final-marksheet/trainee_marks/' + batch_id , function(data) {
                $data = $(data); // the HTML content that controller has produced
                $('#view').hide().html($data).fadeIn();
            });
            event.preventDefault();
        });
    });

</script>

@endpush