@extends('layouts.app') @push('css')
<style type="">
    .profile-pic-wrapper {
        height: 250px;
        width: 250px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .pic-holder {
        text-align: center;
        position: relative;
        border-radius: 50%;
        width: 150px;
        height: 150px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .pic-holder .pic {
        height: 100%;
        width: 100%;
        -o-object-fit: cover;
        object-fit: cover;
        -o-object-position: center;
        object-position: center;
    }

    .pic-holder .upload-file-block,
    .pic-holder .upload-loader {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(90, 92, 105, 0.7);
        color: #f8f9fc;
        font-size: 12px;
        font-weight: 600;
        opacity: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .pic-holder .upload-file-block {
        cursor: pointer;
        opacity: 1;
    }

    .pic-holder:hover .upload-file-block {
        opacity: 1;
    }

    .pic-holder.uploadInProgress .upload-file-block {
        display: none;
    }

    .pic-holder.uploadInProgress .upload-loader {
        opacity: 1;
    }

    /* Snackbar css */
    .snackbar {
        visibility: hidden;
        min-width: 250px;
        background-color: #333;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        left: 50%;
        bottom: 30px;
        font-size: 14px;
        transform: translateX(-50%);
    }

    .snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }
        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            bottom: 0;
            opacity: 0;
        }
        to {
            bottom: 30px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }
        to {
            bottom: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            bottom: 30px;
            opacity: 1;
        }
        to {
            bottom: 0;
            opacity: 0;
        }
    }
</style>
@endpush @section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @isset($user)
                <h1 class="m-0 text-dark">Users Edit</h1>
                @else
                <h1 class="m-0 text-dark">Users Create</h1>
                @endisset
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                @isset($user)
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        @can('users.create')
                        <a href="{{ route('users.create') }}" class="btn btn-sm btn-info m-1"><i class="fas fa-plus-square"></i> Create</a>
                        @endcan
                        <a href="{{url()->previous()}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </ol>
                @else
                <ol class="breadcrumb float-sm-right">
                    <div class="d-inline p-2 text-white text-right">
                        <a href="{{route('users.index')}}" class="btn btn-md btn-success text-right btn-sm m-1" ><i class="fas fa-arrow-left"></i> Back</a>
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary"><i class="fas fa-home"></i> Home</a>
                    </div>
                </ol>
                @endisset
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
                <form action="{{ isset($user) ? route('users.update',$user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf @isset($user) @method('PUT') @endisset

                    <div class="row">
                        <div class="col-md-8">
                                <div class="form-group">
                                    <label for="full_name">Full Name</label>
                                    <input id="full_name" type="text" placeholder="User Name" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ $user->full_name ?? old('full_name') }}" />
                                    @error('full_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input id="name" type="text" placeholder="User Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}" />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}" />
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="c_password">Confirm Password</label>
                                    <input id="c_password" type="password" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" />
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @isset($user)
                                <input type="submit" class="btn btn-primary" value="Update" />
                                @else
                                <input type="submit" class="btn btn-primary" value="Create" />
                                @endisset
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roles">Role Status</label>
                                <select class="form-control @error('role_id') is-invalid @enderror" id="roles" name="role_id">
                                    <option value="">Select User Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @isset($user) {{ $role->id==$user->role_id ?'selected' : '' }} @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label  for="status">Status</label>
                                <select name="is_active" class="form-control @error('is_active') is-invalid @enderror" id="status">
                                    <option value="1"  @isset($user) {{ $user->is_active==1 ?'selected' : '' }} @endif>Active</option>
                                    <option value="0" @isset($user) {{ $user->is_active==0 ?'selected' : '' }} @endif>In Active</option>
                                </select>
                                @error('is_active')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="profile-pic-wrapper">
                                    <div class="pic-holder">
                                        <img id="profilePic" class="pic" src="@isset($user) {{asset('uploads/profile_pic/'.$user->image)}} @endisset" />
                                        <label for="newProfilePhoto" class="upload-file-block">
                                            <div class="text-center">
                                                <div class="mb-2">
                                                    <i class="fa fa-camera fa-2x"></i>
                                                </div>
                                                <div class="text-uppercase">
                                                    Update <br />
                                                    Profile Photo
                                                </div>
                                            </div>
                                        </label>
                                        <input onchange="readURL(this);" class="uploadProfileInput @error('profile_pic') is-invalid @enderror" type="file" name="profile_pic" id="newProfilePhoto"  style="display: none;" />
                                    </div>
                                </div>
                                @error('profile_pic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection @push('js')
<script>
    $("#select-all").click(function (event) {
        if (this.checked) {
            $(":checkbox").each(function () {
                this.checked = true;
            });
        } else {
            $(":checkbox").each(function () {
                this.checked = false;
            });
        }
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#profilePic')
                    .attr('src', e.target.result)
                    .width(250)
                    .height(250);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endpush
