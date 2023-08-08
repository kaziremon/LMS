@extends('layouts.app')
@push('css')
@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Module</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('modules.create')
                        <a href="{{ route('modules.create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> Create</a>
                        @endcan
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
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modules as $key=>$module)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $module->name }} <br>
                            <td>
                                @if(isset($module->created_at))
                                {{ $module->created_at->diffForHumans() }}
                                @else
                                @endif
                            </td>
                            <td>
                                @can('modules.edit')
                                <a href="{{ route('modules.edit',$module->id) }}" class="btn btn-sm btn-success m-1"><i class="fas fa-edit"></i> Edit</a>
                                @endcan
                                @can('modules.destroy')
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $module->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                <form id="delete-form-{{$module->id}}" action="{{route('modules.destroy',$module->id)}}" method="POST" style="display: none;">
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
