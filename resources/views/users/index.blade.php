@extends('layouts.app')
@push('css')
@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">User</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('users.create')
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> Create</a>
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
            <div class="col-md-12 col-x-12 col-sm-12">
                <table id="example1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Create At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key=>$user)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $user->full_name }} <br>
                                @if($user->role)
                                <span style="color: red;font-size: 12px;">{{ $user->role->name }}</span>
                                @else
                                <span style="color: red;font-size: 12px;">No Role Found</span>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            @if($user->is_active==1)
                            <td>Active</td>
                            @else
                            <td>InActive</td>
                            @endif
                            <td> @isset($user->created_at) {{$user->created_at->diffForHumans()}} @endisset</td>

                            <td>
                                @can('users.edit')
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-sm btn-success m-1"><i class="fas fa-edit"></i> Edit</a>
                                @endcan
                                @can('users.destroy')
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $user->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                <form id="delete-form-{{$user->id}}" action="{{route('users.destroy',$user->id)}}" method="POST" style="display: none;">
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
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@endpush
