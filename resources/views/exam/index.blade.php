@extends('layouts.app')
@push('css')
@endpush
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Exam</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-info"><i class="fas fa-home"></i> Home</a>
                     </div>
                     @can('exam.create')
                    <div class="d-inline p-2 text-white">
                        <a href="{{route('exam.create')}}" class="btn btn-md btn-success btn-sm"><i class="fas fa-plus"></i> Create</a>
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
                        {{--  <th scope="col">Created By</th>  --}}
                        <th scope="col">Exam Title</th>
                        {{--  <th scope="col">Course Name</th>
                        <th scope="col">Batch Name</th>  --}}
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $key=>$exam)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            {{--  @if(!empty($exam->user->full_name))
                            <td>{{$exam->user->full_name}}</td>
                            @else
                            <td></td>
                            @endif  --}}
                            <td>{{ $exam->exam_title }}</td>
                            {{--  @if(!empty($exam->course->title))
                            <td>{{ $exam->course->title }}</td>
                            @else
                                <td></td>
                            @endif
                            @if(!empty($exam->batch->name))
                            <td>{{$exam->batch->name}}</td>
                            @else
                            <td></td>
                            @endif  --}}
                            <td>{{ $exam->start_time }}</td>
                            <td>{{ $exam->end_time }}</td>
                            <td>{{ $exam->date }}</td>
                            <td style="display: flex !important">
                                @if($exam->mark_publish==0)
                                    @can('exam.mark_publish')
                                    <button type="submit" class="btn btn-primary btn-sm m-1" onclick="markpublish({{ $exam->id }})"><i class="fas fa-thumbs-up"></i> Exam Mark Publish</button>
                                    <form id="mark-form-{{$exam->id}}" action="{{route('exam.mark_publish',$exam->id)}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                    @endcan
                                @else
                                @if (Auth::user()->role_id==1 || Auth::user()->role_id==2 )
                                <button type="submit" class="btn btn-primary btn-sm m-1" onclick="markpublish({{ $exam->id }})"><i class="fas fa-thumbs-up"></i> Exam Mark Not Publish</button>
                                <form id="status-form-{{$exam->id}}" action="{{route('exam.mark_publish',$exam->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>
                                @endif
                                @endif
                                @if($exam->status==0)
                                @can('exam.status')
                                    <button type="submit" class="btn btn-info btn-sm m-1" onclick="statusUpdate({{ $exam->id }})"><i class="fas fa-thumbs-up"></i> Exam Publish</button>
                                    <form id="status-form-{{$exam->id}}" action="{{route('exam.status',$exam->id)}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                @endcan
                                @else
                                @if (Auth::user()->role_id==1 || Auth::user()->role_id==2 )
                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="statusUpdate({{ $exam->id }})"><i class="fas fa-thumbs-up"></i> Exam  Not Publish</button>
                                <form id="status-form-{{$exam->id}}" action="{{route('exam.status',$exam->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PUT')
                                </form>
                                @endif
                                @endif

                                @if($exam->status==0)
                                    @can('exam.setquestion')
                                    <a href="{{ route('exam.exam_question',$exam->id) }}" class="btn btn-info btn-sm m-1"><i class="fas fa-plus"></i>Set Exam Question</a>
                                    @endcan
                                    @can('exam.destroy')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="deleteCategory({{ $exam->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                    <form id="delete-form-{{$exam->id}}" action="{{route('exam.destroy',$exam->id)}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    @endcan
                                @endif
                                @if($exam->status==0)
                                @can('exam.edit')
                                <a href="{{ route('exam.edit',$exam->id) }}" class="btn btn-success btn-sm m-1"><i class="fas fa-edit"></i> Edit</a>
                                @endcan
                                @else
                                @endif
                                @can('exam.preview')
                                <a href="{{ route('exam.question_privew',$exam->id) }}" class="btn btn-dark btn-sm m-1"><i class="fas fa-eye"></i> Preview</a>
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
                text: "Exam published!",
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
        function markpublish(id) {
            swal({
                title: 'Are you sure?',
                text: "Exam Mark published!",
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
                    document.getElementById('mark-form-'+id).submit();
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
