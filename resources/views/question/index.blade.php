@extends('layouts.app')
@push('css')
@endpush
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Question</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('question.create')
                            <a href="{{ route('question.create') }}" class="btn btn-sm btn-info"><i class="fas fa-plus-square"></i> Create</a>
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
                        <th scope="col">Question Type</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($question as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @if (isset($item->user->full_name) && !empty($item->user->full_name))
                                {{$item->user->full_name}}
                                @else

                                @endif
                            </td>
                            <td>
                                @if (isset($item->chapter->subject->title) && !empty($item->chapter->subject->title))
                                {{$item->chapter->subject->title}}
                                @else

                                @endif

                            </td>
                            <td>
                                @if (isset($item->chapter->name) && !empty($item->chapter->name))
                                {{$item->chapter->name}}
                                @else

                                @endif
                            </td>
                            <td>
                                @if (isset($item->questiontype->name) && !empty($item->questiontype->name))
                                {{$item->questiontype->name}}
                                @else

                                @endif
                            </td>
                            <td>
                                @if (Auth::user()->id==$item->user_id || Auth::user()->role_id==1 || Auth::user()->role_id==2)
                                    @if($item->is_bank==0)
                                        @can('question.edit')
                                        <a href="{{route('question.edit',$item->id)}}" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Edit</a>
                                        @endcan
                                        @can('question.make')
                                        <a href="{{route('question.question_make',$item->id)}}" class="btn btn-primary btn-sm m-1"><i class="fas fa-plus-square"></i> Make Question</a>
                                        @endcan
                                        @can('questionset.edit')
                                        <a href="{{route('question.questionset_edit',$item->id)}}" class="btn btn-secondary btn-sm m-1"><i class="fas fa-edit"></i>Edit Question</a>
                                        @endcan
                                        @can('question.status')
                                        <button type="submit" class="btn btn-info btn-sm m-1" onclick="statusUpdate({{ $item->id }})"><i class="fas fa-thumbs-up"></i> Save To Bank</button>
                                        <form id="status-form-{{$item->id}}" action="{{route('question.status',$item->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        @endcan
                                        @can('question.destroy')
                                        <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $item->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                        <form id="delete-form-{{$item->id}}" action="{{route('question.destroy',$item->id)}}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endcan
                                    @endif
                                    @else
                                @endif
                                @can('questionset.preview')
                                    <a href="{{route('question.questionset_preview',$item->id)}}" class="btn btn-secondary btn-sm m-1"><i class="fas fa-eye"></i> Preview</a>
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
    function statusUpdate(id) {
            swal({
                title: 'Are you sure?',
                text: "Set Question To Question Bank!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!',
                cancelButtonText: 'No!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('status-form-'+id).submit();
                } else if (
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
</script>
@endpush
