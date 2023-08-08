@extends('layouts.app')
@push('css')@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px; font-weight: bold">Course</div>
                @can('course.create')
                <div class="d-inline p-2 text-white">
                    <a href="{{route('course.create')}}" class="btn btn-md btn-outline-primary"><i class="fas fa-plus-square"></i> Create Course</a>
                </div>
                @endcan
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
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
                          <th scope="col">#</th>
                          <th scope="col">Course title</th>
                          <th scope="col">Created By</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($courses as $key=>$course)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->user->name }}</td>
                            <td style="display: inline-flex">
                                @can('course.edit')
                                <a href="{{ route('course.edit',$course->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                @endcan
                                @can('course.destroy')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="deleteCategory({{ $course->id }})"><i class="fas fa-trash"></i> Delete</button>
                                <form id="delete-form-{{$course->id}}" action="{{ route('course.destroy', $course->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
