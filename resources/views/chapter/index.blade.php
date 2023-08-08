@extends('layouts.app')
@push('css')
@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Chapter</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('chapter.create')
                            <a href="{{ route('chapter.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus-square"></i> Create</a>
                        @endcan
                        <a href="{{ url()->previous() }}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
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
                        <th scope="col">#</th>
                        <th scope="col">Author</th>
                        <th scope="col">Subject Name</th>
                        <th scope="col">Chapter Name</th>
                        <th scope="col">Learning OutCome</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($chapter as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if (isset($item->user->full_name) && !empty($item->user->full_name))
                                {{$item->user->full_name}}
                                @else

                                @endif
                            </td>
                            <td>
                                @if (isset($item->subject->title) && !empty($item->subject->title))
                                {{$item->subject->title}}
                                @else

                                @endif
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->learning_outcome}}</td>
                            <td>
                                @can('chapter.edit')
                                    <a href="{{route('chapter.edit',$item->id)}}" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Edit</a>
                                @endcan
                                @can('chapter.destroy')
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $item->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                <form id="delete-form-{{$item->id}}" action="{{route('chapter.destroy',$item->id)}}" method="POST" style="display: none;">
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
