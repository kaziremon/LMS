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
                   @can('forum.index')
                        <div class="d-inline p-2 text-white text-right">
                            <a href="{{ route('forum.index') }}" class="btn btn-sm btn-primary text-right"><i class="fas fa-arrow-circle-left"></i> Back</a>
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
            <div class="col-md-12 col-x-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">Create By</div>
                        <div class="d-inline p-2  text-dark" style="font-size: 26px;font-weight: bold">{{$forum->user->name}}</div>
                        <div class="d-inline p-2 text-right text-dark" style="float: right">
                          @if(empty($favourit))
                          <button id="add_favoruit" style="border: none;background:none;">
                            <i class="@if(!isset($favourit))far @else fas @endif fa-heart" id="heart"></i> <span>{{$count}}</span>
                          </button>
                          <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                          <input type="hidden" value="{{$forum->id}}" id="forum_id">
                          @else
                          <button id="remove_favoruit" style="border: none;background:none;">
                            <i class="fas fa-heart" id="heart"></i><span>{{$count}}</span>
                          </button>
                          <input type="hidden" value="{{Auth::user()->id}}" id="user_id">
                          <input type="hidden" value="{{$forum->id}}" id="forum_id">
                          @endif
                        </div>
                        @if (Auth::user()->id==$forum->user_id)
                        <div class="d-inline p-2 text-right text-dark" style="float: right">
                          <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $forum->id }})"><i class="fas fa-trash"></i> DELETE</button>
                            <form id="delete-form-{{$forum->id}}" action="{{route('forum.destroy',$forum->id)}}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                        <div class="d-inline p-2 text-right text-dark" style="float: right">
                          <a href="{{route('forum.edit',$forum->id)}}" class="btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                      <blockquote class="blockquote mb-0">
                        <p>{{$forum->title}}</p>
                        <footer class="blockquote-footer">{{strip_tags($forum->description)}}</footer>
                      </blockquote>
                    </div>
                </div>
                @foreach ($replys as $reply)
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline p-2  text-dark" style="font-size: 18px;font-weight: bold">Reply By {{$reply->user->name}} </div>

                        <div class="d-inline p-2 text-right text-dark" style="float: right">
                          {{ $reply->created_at->diffForHumans() }}
                        </div>
                    </div>
                    <div class="card-body">
                      <blockquote class="blockquote mb-0 d-inline">
                        <p>{{$reply->comment}}</p>
                        <footer class="blockquote-footer">
                          @php
                           $user=Auth::user()->id;
                          @endphp
                          @if ($user==$reply->user_id)
                          <button type="button" class="btn btn-success btn-sm" id="replyupdate" data-toggle="modal" data-target="#exampleModal" data-id="{{ $reply->id }}">
                            <i class="fas fa-edit"></i> Edit
                          </button>
                          @endif
                          <button type="submit" class="btn btn-danger btn-sm m-1" onclick="deleteCategory({{ $reply->id }})"><i class="fas fa-trash"></i> DELETE</button>
                          <form id="delete-form-{{$reply->id}}" action="{{route('forumreply.destroy',$reply->id)}}" method="POST" style="display: none;">
                              @csrf
                              @method('DELETE')
                          </form>
                        </footer>
                      </blockquote>
                    </div>
                </div>
                @endforeach
                <form action="{{route('forumreply.store')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea id="" class="form-control" rows="5" name="comment" class="noting @error('comment') is-invalid @enderror">{{old('comment') }}</textarea>
                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input type="hidden" name="forum_id" value="{{$forum->id}}">
                    </div>
                    <input type="submit" class="btn btn-success" value="Comment">
                </div>
                </form>

            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form action="{{route('forumreply.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <textarea name="editcomment" id="editcomment" cols="62" rows="5" required></textarea>
            </div>
            <input type="hidden" name="hidden_id" id="hidden_id" value="" />
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="replyUpdate" class="btn btn-success">Update</button>
            </div>
          </div>
        </div>
      </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection

@push('js')
<script>
    $(function () {
       $('#summernote').summernote({
       height: 180
     });
   });
</script>

<script>

  $(document).ready(function () {

  $.ajaxSetup({
      headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
  });

  $('body').on('click', '#replyUpdate', function (event) {
      event.preventDefault()
      var hidden_id = $("#hidden_id").val();
      var editcomment = $("#editcomment").val();
      console.log(editcomment);
      $.ajax({
        url: '/reply/update',
        type: "PUT",
        data: {
          _token: "{{ csrf_token() }}",
          hidden_id: hidden_id,
          editcomment: editcomment,
        },
        dataType: 'json',
        success: function (data) {
            $('#exampleModalCenter').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Comment Updated Successfully!',
                timer: 1500
                });
            window.location.reload(true);
        },
      error:function(e){
        Swal.fire({
                icon: 'error',
                title: 'Comment Not Updated!',
                timer: 1500
                });
      },
    });
  });

  $('body').on('click', '#replyupdate', function (event) {

      event.preventDefault();
      var id = $(this).data('id');
      $.get('reply/edit/'+ id, function (data) {
          var comment=data.data.comment;
           $('#exampleModal').modal('show');
           $('#editcomment').val(comment);
           $('#hidden_id').val(id);
       })
  });

  $('body').on('click', '#add_favoruit', function (event)
    {
            event.preventDefault();
            var forum_id = $("#forum_id").val();
            var user_id = $("#user_id").val();
            var favourit ='1';
            var add_favoruit='add_favoruit';
            var remove_favoruit='remove_favoruit';
            $.ajax({
                url: "/forum/favourit",
                method: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    forum_id: forum_id,
                    favourit: favourit,
                    user_id: user_id,
                },
                success: function (response) {
                  window.location.reload(true);
                },
                error: function (error) {

                },
            });
    });
    $('body').on('click', '#remove_favoruit', function (event)
    {
            event.preventDefault();
            var forum_id = $("#forum_id").val();
            var user_id = $("#user_id").val();
            var heart='heart';
            $.ajax({
                url: "favourit/delete",
                method: "delete",
                data: {
                    _token: "{{ csrf_token() }}",
                    forum_id: forum_id,
                    user_id: user_id,
                },
                success: function (response) {
                  window.location.reload(true);
                },
                error: function (error) {
                    console.log(error);
                },
            });
    });

  });
  </script>
@endpush
