@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('roles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit Role {{ $roles->name }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></div>
                    <div class="breadcrumb-item">Edit Role {{ $roles->name }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit Role</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('roles.update', $roles->id) }}"
                                    enctype="multipart/form-data" id="formEditRoles">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row mb-4">
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Role</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $roles->name }}">
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Hak Akses</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label">Admin</label>
                                <div class="custom-switches-stacked mt-4">
                                    <label class="custom-switch">
                                        <input type="checkbox" id="toggleAdmin" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Pilih Semua</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @php
                            $groupedPermissions = $permissions->groupBy('menu_name');
                        @endphp

                        @foreach ($groupedPermissions as $menuName => $menuPermissions)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">Menu {{ $menuName }}</label>
                                    <div class="custom-switches-stacked mt-4">
                                        @foreach ($menuPermissions as $permission)
                                            <label class="custom-switch">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                    class="custom-switch-input"
                                                    {{ in_array($permission->id, $roles->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <button class="btn btn-primary float-left">Update Role</button>

            </form>

        </section>
    </div>

    <script>
        document.getElementById('toggleAdmin').addEventListener('change', function() {

            var togglePermissions = document.querySelectorAll('[name^="permissions["]');

            togglePermissions.forEach(function(toggle) {
                toggle.checked = document.getElementById('toggleAdmin').checked;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formEditRoles").on("submit", function(e) {
                e.preventDefault();

                var rolesId = "{{ $roles->id }}";
                
                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                // Kirim data ke server menggunakan AJAX
                $.ajax({
                    type: 'POST',
                    url: '{{ route('roles.update', ['role' => ':rolesId']) }}'.replace(':rolesId',
                        rolesId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('roles.index') }}';
                            });
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
                            // Menampilkan pesan kesalahan dari respons JSON
                            var errorMessage = xhr.responseJSON
                                .message; // Mendapatkan pesan kesalahan dari controller
                            Swal.fire('Gagal', errorMessage,
                                'error'); // Menampilkan pesan kesalahan di SweetAlert
                        }
                    },

                });
            });
        });
    </script>
@endsection
