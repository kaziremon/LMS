@extends('layouts.app')
@push('css')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Exam Given List</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="{{ route('exam.evaluation') }}" class="btn btn-sm btn-success text-right m-1" >Back</a>
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
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12" style="text-align: center">
            @isset($exam->exam_title)
                <h3 class="font-weight-bold">Exam Title:{{$exam->exam_title}}</h3>
            @endisset
            @isset($exam->course->title)
            <p class="font-weight-bold">Course:{{$exam->course->title}}</p>
            @endisset
            @isset($exam->batch->name)
            <p class="font-weight-bold">Batch:{{$exam->batch->name}}</p>
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
                <table id="datatable" class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <td scope="col">Name</td>
                        <th scope="col">Batch</th>
                        <th scope="col">Submit Time</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($examsubmit as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>

                                @if (isset($item->user->full_name))
                                    {{$item->user->full_name}}
                                @else

                                @endif
                            </td>
                            <td>
                                @if (isset($item->user->batch->name))
                                    {{$item->user->batch->name}}
                                @else

                                @endif
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->format('g:i A') }}</td>
                            <td>
                                @can('exam.evulation_mark')
                                <a href="{{ route('exam.evulation_mark',$item->id) }}" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Mark Publish</a>

                                @endcan
                                @can('evaluation.view')
                                <a href="{{ url('exam/evaluation/mark/view',$item->id) }}" class="btn btn-success btn-sm m-1"><i class="far fa-eye"></i> View</a>
                                @endcan
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
