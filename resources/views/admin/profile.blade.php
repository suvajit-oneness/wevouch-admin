@extends('layouts.auth.master')

@section('title', 'Profile')

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center position-relative">
                            <img class="profile-user-img img-fluid img-circle" src="{{ asset(Auth::user()->image_path) }}" alt="profile-picture">

                            <div class="change-image">
                                <label for="upload_image" class="badge badge-primary" title="Change profile picture"><i class="fas fa-camera"></i></label>
                                <input type="file" name="upload_image" id="upload_image" class="d-none" accept="image/*">
                            </div>
                        </div>
                        <div class="text-center my-3">
                            @php echo '<span class="badge bg-danger rounded-0"><h6 class="mb-0 font-weight-bold">Administrator</h6></span>'; @endphp
                        </div>
                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings-tab" data-toggle="tab">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#password-tab" data-toggle="tab">Password</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings-tab">
                                <form class="form-horizontal" method="POST" action="{{ route('user.profile.update') }}" id="profile-form">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Name" value="{{ old('name') ? old('name') : Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}" disabled>

                                            <p class="small text-muted mt-2 mb-0">Email id cannot be changed once registered</p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputMobile" class="col-sm-2 col-form-label">Phone number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputMobile" name="mobile" placeholder="Phone number" value="{{ old('mobile') ? old('mobile') : Auth::user()->mobile }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="password-tab">
                                <form class="form-horizontal" method="POST" action="{{ route('user.password.update') }}" id="password-form">
                                    <div class="form-group row">
                                        <label for="oldPassword" class="col-sm-2 col-form-label">Old</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-2 col-form-label">New</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // profile update
            $('#profile-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url : $(this).attr('action'),
                    method : $(this).attr('method'),
                    data : {'_token' : '{{csrf_token()}}', name : $('#inputName').val(), mobile : $('#inputMobile').val()},
                    success : function(result) {
                        if(result.error == true){
                            toastFire('danger', result.message);
                        } else {
                            $('.profile-username').text($('#inputName').val());
                            $('.main-sidebar .info a').text($('#inputName').val());
                            toastFire(result.type, result.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastFire('danger', 'Something Went wrong');
                    }
                });
            });

            // password update
            $('#password-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url : $(this).attr('action'),
                    method : $(this).attr('method'),
                    data : {'_token' : '{{csrf_token()}}', oldPassword : $('#oldPassword').val(), password : $('#newPassword').val(), password_confirmation : $('#confirmPassword').val()},
                    success : function(result) {
                        if(result.error == true){
                            toastFire('danger', result.message);
                        } else {
                            $('#oldPassword').val('');
                            $('#newPassword').val('');
                            $('#confirmPassword').val('');
                            toastFire('success', result.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastFire('danger', 'Something Went wrong');
                    }
                });
            });

            // image change
            $image_crop = $('#image_demo').croppie({
                enableExif: true,
                viewport: {
                    width: 150,
                    height: 150,
                    type: 'circle'
                },
                boundary: {
                    width: 200,
                    height: 200
                }
            });

            $('#upload_image').on('change', function () {
                var reader = new FileReader();
                reader.onload = function (event) {
                    $image_crop.croppie('bind', {
                        url: event.target.result
                    });
                }
                reader.readAsDataURL(this.files[0]);
                $('#uploadimageModal').modal('show');
            });

            $('.crop_image').click(function (event) {
                $image_crop.croppie('result', {
                    type: 'canvas',
                    size: 'viewport'
                }).then(function (response) {
                    $.ajax({
                        url: "{{route('user.profile.image.update')}}",
                        type: "POST",
                        data: {
                            "_token": '{{ csrf_token() }}',
                            "image": response
                        },
                        success: function (result) {
                            $('#uploadimageModal').modal('hide');
                            if(result.error == true){
                                toastFire('danger', result.message);
                            } else {
                                $('#image_demo').html('');
                                $('.profile-user-img').attr('src', result.image);
                                $('.sidebar .user-panel img').attr('src', result.image);
                                toastFire('success', result.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            toastFire('danger', 'Something Went wrong');
                        }
                    });
                })
            });
        });
    </script>
@endsection