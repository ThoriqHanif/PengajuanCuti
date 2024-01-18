@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('roles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Create New Role</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></div>
                    <div class="breadcrumb-item">Create New Role</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah Role</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('roles.store') }}" enctype="multipart/form-data"
                                id="formRoles">
                                @csrf
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Role</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="name" id="name">
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
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}" class="custom-switch-input">
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
            <button class="btn btn-primary float-left">Create Role</button>
        </form>

        </section>
    </div>

    <script>
        // Menangani perubahan status toggle admin
        document.getElementById('toggleAdmin').addEventListener('change', function() {
            // Mengambil semua toggle permissions
            var togglePermissions = document.querySelectorAll('[name^="permissions["]');
    
            // Mengatur status toggle permissions berdasarkan status toggle admin
            togglePermissions.forEach(function(toggle) {
                toggle.checked = document.getElementById('toggleAdmin').checked;
            });
        });
    </script>

<script>
    $(document).ready(function() {
        $("#formRoles").on("submit", function(e) {
            e.preventDefault();

            // Tampilkan pesan "loading" saat akan mengirim permintaan AJAX
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
                url: '{{ route('roles.store') }}',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    // Tutup pesan "loading" saat berhasil
                    Swal.close();

                    if (response.success) {
                        // Redirect ke halaman index dengan pesan "success"
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data berhasil disimpan.',
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
                            Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data',
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
                        Swal.fire('Gagal', 'Terjadi kesalahan saat simpan data.', 'error');
                    }
                },
            });
        });
    });
</script>
@endsection
