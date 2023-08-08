@extends('layouts.app') @push('css')
@endpush @section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Topic Type</div>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <div class="d-inline-right p-2 text-white text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-md btn-success text-right" >Back</a>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
            <div class="col-md-12 col-x-12 col-sm-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#question" data-toggle="tab">Question</a></li>
                            <li class="nav-item"><a class="nav-link" href="#add_question" data-toggle="tab">Create Question</a></li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="question">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Question Type</th>
                                            <th scope="col">Action</th>
                                        </tr>

                                        @foreach ($TopicTypes as $key=>$topictype)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$topictype->title}}</td>
                                            <td>{{$topictype->examtype->name}}</td>
                                            <td class="action">
                                                @if($topictype->user_id==Auth::user()->id || Auth::user()->role_id==1)
                                                <a href="{{ url('questionbank/question',$topictype->id) }}" class="btn btn-sm btn-success m-1"><i class="fas fa-plus"></i> Create Question</a>
                                                <a href="#" class="btn btn-sm btn-info  m-1" id="topictype" data-toggle="modal" data-target="#topictypeModalCenter" data-id="{{ $topictype->id }}"><i class="fas fa-edit"></i>Edit</a>
                                                <a href="{{route('questionbankmanage',$topictype->id)}}" class="btn btn-sm btn-primary m-1"><i class="fas fa-eye"></i> Preview</a>
                                                <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $topictype->id }})"><i class="fas fa-trash"></i> DELETE</button>
                                                <form id="delete-form-{{$topictype->id}}" action="{{route('topictypedestroy',$topictype->id)}}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="add_question">
                                <form action="{{route('topictypesstore') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input id="title"  type="text" placeholder="Title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title') }}" required />
                                        @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" value="{{$QuestionBank->id}}" name="questionbank_id" />
                                        <label for="question_type">Question Type select</label>
                                        <select class="form-control @error('question_type') is-invalid @enderror" id="question_type" required name="question_type">
                                            @foreach ($examtypes as $examtype)
                                            <option value="{{$examtype->id}}">{{$examtype->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('question_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <input type="submit" value="Create" class="btn btn-success">
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="topictypeModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{url('topictypes/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="edittitle" minlength="6" type="text" placeholder="Title" class="form-control @error('title') is-invalid @enderror" name="title" value="" required />
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="question_type">Question Type select</label>
                        <select class="form-control @error('question_type') is-invalid @enderror" id="question_type" required name="question_type">
                            @foreach ($examtypes as $examtype)
                            <option value="{{$examtype->id}}">{{$examtype->name}}</option>
                            @endforeach
                        </select>
                        @error('question_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <input type="hidden" name="hidden_id" id="hidden_id" value="" />
                    <input type="submit" class="btn btn-danger" value="Update" id="submit" />
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
          </div>
        </div>
      </div>
</section>
<!-- /.col -->

<!-- jQuery -->

@endsection

@push('js')

<script>

    $(document).ready(function () {

    $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    $('body').on('click', '#submit', function (event) {
        event.preventDefault()
        var hidden_id = $("#hidden_id").val();
        var edittitle = $("#edittitle").val();
        $.ajax({
          url: 'topic/update',
          type: "PUT",
          data: {
            _token: "{{ csrf_token() }}",
            hidden_id: hidden_id,
            edittitle: edittitle,
          },
          dataType: 'json',
          success: function (data) {
              $('#topictypeModalCenter').modal('hide');
              Swal.fire({
                icon: 'success',
                title: 'Data Update Success!',
                timer: 1500
                });
              window.location.reload(true);
          },
        error:function(e){
            Swal.fire({
                icon: 'error',
                title: 'Data Update Fail!',
                timer: 1500
            });
        },
      });
    });

    $('body').on('click', '#topictype', function (event) {

        event.preventDefault();
        var id = $(this).data('id');
        $.get('topic/' + id + '/edit', function (data) {
            var title=data.data.title;
            var examtypes=data.data.examtype_id;
             $('#topictypeModalCenter').modal('show');
             $('#edittitle').val(title);
             $('#hidden_id').val(id);
         })
    });

    });
    </script>
@endpush
