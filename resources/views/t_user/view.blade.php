@extends('layouts.app') @push('css') @endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2 text-dark" style="font-size: 26px; font-weight: bold;">User Assigned</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('user_assigned.create')
                        <a href="{{ url('user/assigned/create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> User Assigned </a>
                        @endcan
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1"><i class="fas fa-arrow-left"></i> Back</a>
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
            <div class="col-md-12 col-x-12 col-sm-12">
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Batch Name</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">Assigned Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=>$item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>@isset($item->course_id) {{$item->course->title}} @endisset</td>
                            <td>@isset($item->batch_id) {{$item->batch->name}} @endisset</td>
                            <td>@isset($item->role_id) {{$item->role->name}} @endisset</td>
                            <td>@isset($item->created_at) {{$item->created_at->diffForHumans()}} @endisset</td>
                            <td>
                                @can('user_assigned.destroy')
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $item->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                <form id="delete-form-{{$item->id}}" action="{{route('assigned.destroy',$item->id)}}" method="POST" style="display: none;">
                                    @csrf @method('DELETE')
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

@endsection @push('js')
<script>
    $(function () {
        $("#example1")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    });
</script>
@endpush
