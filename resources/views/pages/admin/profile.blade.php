@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ $user->username }}!</h2>
                <p class="section-lead">
                    Change information about yourself on this page.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                @if ($photoUrl)
                                    <img alt="image" src="{{ $photoUrl }}"
                                        class="rounded-circle profile-widget-picture">
                                @else
                                    <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle profile-widget-picture">
                                @endif

                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Posts</div>
                                        <div class="profile-widget-item-value">187</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Followers</div>
                                        <div class="profile-widget-item-value">6,8K</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Following</div>
                                        <div class="profile-widget-item-value">2,1K</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ $user->full_name }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> {{ $user->position->name }}
                                    </div>
                                </div>
                                Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a
                                fictional character but an original hero in my family, a hero for his children and for his
                                wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with
                                <b>'John Doe'</b>.
                            </div>
                            <div class="card-footer text-center">
                                <div class="font-weight-bold mb-2">Follow Ujang On</div>
                                <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-github mr-1">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" id="formProfile" action="{{ url('profile') }}" enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" value="{{ $user->full_name }}"
                                                required="" name="full_name" id="full_name">
                                            <div class="invalid-feedback">
                                                Please fill in the full name
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>Username</label>
                                            <input type="text" class="form-control" value="{{ $user->username }}"
                                                required="" name="username" id="username">
                                            <div class="invalid-feedback">
                                                Please fill in the username
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label>Email</label>
                                            <input type="email" class="form-control" value="{{ $user->email }}"
                                                required="" name="email" id="email">
                                            <div class="invalid-feedback">
                                                Please fill in the email
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>No Handphone</label>
                                            <input type="number" class="form-control" value="{{ $user->telp }}"
                                                name="telp" id="telp">
                                        </div>
                                        <div class="form-group col-md-7 col-12">
                                            <label>Password</label>
                                            <div class="input-group">
                                                <input type="password" class="form-control" value="" name="password"
                                                    id="password">
                                                <div class="input-group-append" id="togglePassword">
                                                    <div class="input-group-text bg-white" style="cursor: pointer">
                                                        <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="invalid-feedback">
                                                Please fill in the email
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="address" id="address">{{ $user->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Foto Profile</label>
                                            <div class="">
                                                <div id="image-preview" class="image-preview">
                                                    <label for="image-upload" id="image-label">Choose File</label>
                                                    <input type="file" name="photo" id="image-upload" class="photo" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @can('edit profile')
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                @endcan

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const passwordField = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const togglePasswordIcon = document.getElementById('togglePasswordIcon');

        togglePassword.addEventListener('click', function() {
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                togglePasswordIcon.classList.remove('fa-eye');
                togglePasswordIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                togglePasswordIcon.classList.remove('fa-eye-slash');
                togglePasswordIcon.classList.add('fa-eye');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formProfile").on("submit", function(e) {
                e.preventDefault();

                var userId = "{{ $user->id }}";

                var username = $("#username").val();
                var email = $("#email").val();
                var full_name = $("#full_name").val();
                var telp = $("#telp").val();
                var address = $("#address").val();

                var password = $("#password").val();
                var photo = $(".photo")[0].files[0]; // Ambil foto yang diunggah

                // console.log(username, email, full_name, telp);

                var emailChanged = email !== "{{ $user->email }}";
                var passwordChanged = password !== "";

                var prevUsername = "{{ $user->username }}";
                var prevFullName = "{{ $user->full_name }}";
                var prevTelp = "{{ $user->telp }}";
                var prevAddress = "{{ $user->address }}";
                var prevPhoto = "{{ $photoUrl }}";



                var userChanged = username !== prevUsername || full_name !== prevFullName || telp !==
                    prevTelp ||
                    address !== prevAddress || ($(".photo")[0].files.length > 0);

                if (username === "{{ $user->username }}" && !emailChanged && !passwordChanged && !
                    userChanged) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Data tidak ada yang berubah.',
                    });
                    return;
                }

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                var formData = new FormData(this);
                formData.append('_method', 'PUT');
                formData.append('photo', photo);


                $.ajax({
                    type: 'POST',
                    url: '{{ route('profile.update', ['user' => ':userId']) }}'.replace(':userId',
                        userId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tutup pesan "loading" saat berhasil
                        // console.log(response);
                        Swal.close();

                        if (response.success) {
                            if (emailChanged || passwordChanged) {
                                // Logout jika email atau password berubah
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil diupdate. Silahkan login ulang.',
                                }).then(function() {
                                    window.location.href = '{{ route('login') }}';
                                });
                            } else {
                                // Redirect ke halaman profile jika hanya nama yang diubah
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil diupdate.',
                                }).then(function() {
                                    window.location.href = '{{ route('profile') }}';
                                });
                            }
                        } else {
                            // Jika validasi gagal, tampilkan pesan-pesan kesalahan
                            if (response.errors) {
                                var errorMessages = '';
                                for (var key in response.errors) {
                                    if (response.errors.hasOwnProperty(key)) {
                                        errorMessages += response.errors[key][0] + '<br>';
                                    }
                                }
                                Swal.fire('Gagal', errorMessages, 'error');
                            } else {
                                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data',
                                    'error');
                            }
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        if (xhr.status === 422) {
                            // Menampilkan pesan validasi error SweetAlert
                            var errorMessages = '';
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages += errors[key][0] + '<br>';
                                }
                            }
                            Swal.fire('Gagal', errorMessages, 'error');
                        } else {
                            Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                        }
                    },
                });
            });
        });
    </script>
@endsection
