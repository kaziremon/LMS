@extends('layouts.app')
@push('css')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Mark Sheet </div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
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
            <div class="col-md-12 col-x-12 col-sm-12 table-responsive p-3">
                <table  id="dataTableHover" class="table align-items-center table-flush table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Sl</th>
                            <th scope="col">Exam Name</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Total Mark</th>
                            <th scope="col">Obtained Mark</th>
                            
                        </tr>
                    </thead>
                    <tbody name="body">
                        @forelse ($marks as $key=>$mark)
                        <tr>
                           <th scope="row">{{ $key+1 }}</th>
                            <td> {{ $mark->exam_title }} </td>
                            <td> {{ $mark->title }} </td>
                            <td> {{ $mark->batch_name }} </td>
                            @if($mark->mark_publish == 1)
                            <td> {{ $mark->total_mark }} </td>
                            <td>{{ $mark->obtained_mark }}</td>
                            @else
                            <td> Not published yet </td>
                            <td> Not published yet </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center">No exam found for this Student</td>
                        </tr>
                        @endforelse
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
