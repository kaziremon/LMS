@extends('layouts.app')
@push('css')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Forum Category</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    </div>
                    @can('forum_category.create')
                        <div class="d-inline p-2 text-white">
                            <a href="{{route('category.create')}}" class="btn btn-md btn-success btn-sm"><i class="fas fa-plus"></i> Create</a>
                        </div>
                    @endcan
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
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key=>$item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $item->name }} <br>
                            <td>{{ $item->created_at->diffForHumans() }}</td>
                            <td style="display: flex">
                                @can('forum_category.edit')
                                <a href="{{ route('category.edit',$item->id) }}" class="btn btn-sm btn-success m-1"><i class="fas fa-edit"></i> Edit</a>
                                @endcan
                                @can('forum_category.destroy')
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $item->id }})"><i class="fas fa-trash"></i> Delete</button>
                                <form id="delete-form-{{$item->id}}" action="{{route('category.destroy',$item->id)}}" method="POST" style="display: none;">
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
