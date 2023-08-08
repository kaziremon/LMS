@extends('layouts.app')
@push('css')
@endpush
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Forum</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                    </div>
                    @can('forum.create')
                    <div class="d-inline p-2 text-white">
                        <a href="{{route('forum.create')}}" class="btn btn-md btn-success btn-sm"><i class="fas fa-plus"></i> Create</a>
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
            @foreach ($forums as $forum)
            <div class="col-md-12 col-x-12 col-sm-12">
                <a href="{{route('forum.details',$forum->id)}}">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-inline p-2  text-dark" style="font-size: 20px;font-weight: bold">Crated By {{$forum->user->name}} <span></span></div>
                            @if (Auth::user()->id==$forum->user_id)
                            <div class="d-inline p-2 text-right text-dark" style="float: right">
                                @can('forum.edit')
                                    <a href="{{route('forum.edit',$forum->id)}}" class="btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i> Edit</a>
                                @endcan
                                @can('forum.destroy')
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $forum->id }})"><i class="fas fa-trash"></i> Delete</button>
                                <form id="delete-form-{{$forum->id}}" action="{{route('forum.destroy',$forum->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endcan
                            </div>
                            @endif
                        </div>
                        <a href="{{route('forum.details',$forum->id)}}">
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <p>{{$forum->title}}</p>
                                    <footer class="blockquote-footer">{{$forum->description}}</footer>
                                </blockquote>
                            </div>
                        </a>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('js')
@endpush
