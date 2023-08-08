@extends('layouts.app') @section('content') @push('css')
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
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <br />
                <h4>Update Your Information</h4>
                <hr />
                <br />
            </div>
            <div class="col-md-6 col-x-6 col-sm-6">
                <form action="{{route('userprofile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-12 col-x-12 col-sm-12">
                            @if(session()->has('error'))
                            <span class="alert alert-danger">
                                <strong>{{ session()->get('error') }}</strong>
                            </span>
                            @endif @if(session()->has('success'))
                            <span class="alert alert-success">
                                <strong>{{ session()->get('success') }}</strong>
                            </span>
                            @endif
                            <br />
                            <div class="profile-pic-wrapper">
                                <div class="pic-holder">
                                    @if(Auth::user()->profile_pic)
                                   
                                    <img id="profilePic" class="pic" src="{{asset(Auth::user()->profile_pic) }}" />
                                    @else 
                                    <img id="profilePic" class="pic" src="{{asset('download.jpg')}}" />
                                    @endif
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
                                    @error('profile_pic')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="full_name">Full Name</label>
                                <input id="full_name" type="text" placeholder="User Name" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ Auth::user()->full_name ?? old('full_name') }}" />
                                @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input id="name" type="text" placeholder="User Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name ?? old('name') }}" />
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email ?? old('email') }}" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="oldpassword">Old Password</label>
                                <input id="oldpassword" type="password" placeholder="Old Password" class="form-control @error('oldpassword') is-invalid @enderror" name="oldpassword" />
                                @error('oldpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="newpassword">New Password</label>
                                <input id="newpassword" type="password" placeholder="New Password" class="form-control @error('newpassword') is-invalid @enderror" name="newpassword" />
                                @error('newpassword')
                                <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <input type="submit" class="btn btn-success" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br><br>
        <!-- /.row (main row) -->
    </div>
    <!-- /.container-fluid -->
</section>

@endsection @push('js')
<script>
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
