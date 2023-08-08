@extends('layouts.app')
@push('css')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Exam Evaluation</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{ url()->previous() }}" class="btn btn-sm btn-success text-right m-1" >Back</a>
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="btn btn-sm btn-info m-1">Home</a></li>
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
            <div class="col-md-12 col-x-12 col-sm-12">
                <table id="datatable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Exam Title</th>
                        <th scope="col">Batch</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Date</th>
                        <th scope="col">Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($exams as $key=>$exam)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            @if(!empty($exam->exam_title))
                            <td>{{$exam->exam_title }}</td>
                            @else
                                <td></td>
                            @endif
                            @if(!empty($exam->batch->name))
                            <td>{{$exam->batch->name}}</td>
                            @else
                            <td></td>
                            @endif
                            <td>{{ $exam->start_time }}</td>
                            <td>{{ $exam->end_time }}</td>
                            <td>{{ $exam->date }}</td>
                            <td>
                                @can('exam.evaluation_list')
                                <a href="{{route('exam.evaluation_list',$exam->id)}}" class="btn btn-success btn-sm m-1">Manage</a>
                                @endcan
                            </td>
                          </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('js')
@endpush
