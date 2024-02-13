@if (!$users->trashed())
    @can('show users')
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
            data-placement="top" title="Detail User" data-users-id="{{ $users->id }}"
            href="{{ route('users.show', $users->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @endcan

    @can('edit users')
        <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-user" data-placement="top" id="btn-edit-user"
            title="Edit User" data-users-id="{{ $users->id }}" data-users-level="{{ $users->position->level }}"
            href="{{ route('users.edit', $users->id) }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan


    @can('delete users')
        <form style="display: inline" action="{{ route('users.destroy', $users->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
                title="Hapus User">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endif

@if ($users->trashed())
    @can('restore users')
        <form style="display: inline" action="{{ route('user.restore', $users->id) }}" method="POST" id="restoreFormUsers">
            @csrf
            <button type="submit" class="btn btn-sm btn-info restore-button-users" data-toggle="tooltip"
                data-placement="top" title="Restore User">
                <i class="fas fa-undo"></i>
            </button>

        </form>
    @endcan
    @can('force-delete users')
        <form style="display: inline" action="{{ route('user.forceDelete', $users->id) }}" method="POST"
            id="forceDeleteFormUsers">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-button-users" data-toggle="tooltip"
                data-placement="top" title="Hapus Permanen User">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endif



<script>
    $(document).ready(function() {
        // Memberikan event handler untuk tombol hapus
        $('.delete-button').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Anda yakin ingin menghapus user ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus User...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    // Jika pengguna mengkonfirmasi penghapusan, kirimkan permintaan penghapusan
                    $.ajax({
                        type: 'POST',
                        url: deleteButton.closest('form').attr('action'),
                        data: deleteButton.closest('form').serialize(),
                        success: function(response) {
                            // Tutup pesan "loading"
                            Swal.close();

                            // Handle pesan hasil penghapusan
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data user berhasil dihapus.',
                                }).then(function() {
                                    $('#tableUsers').DataTable().ajax
                                        .reload();

                                });
                                // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus user',
                                    'error');
                            }
                        },
                        error: function() {
                            // Tutup pesan "loading"
                            Swal.close();

                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus user',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Event handler untuk tombol restore
        $('.restore-button-users').on('click', function(e) {
            e.preventDefault();
            var restoreButton = $(this);
            var restoreForm = restoreButton.closest('#restoreFormUsers');

            Swal.fire({
                title: 'Konfirmasi Restore',
                text: 'Anda yakin ingin mengembalikan User ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Restore',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang mengembalikan User...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    $.ajax({
                        type: 'POST',
                        url: restoreForm.attr('action'),
                        data: restoreForm.serialize(),
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'User berhasil di-restore.',
                                }).then(function() {

                                    $('#tableUsersTrashed').DataTable()
                                        .ajax.reload();

                                });
                            } else {
                                Swal.fire('Gagal', 'Gagal mengembalikan User',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat mengembalikan User',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Event handler untuk tombol "Force Delete"
        $('.delete-button-users').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            var deleteForm = deleteButton.closest('#forceDeleteFormUsers');

            Swal.fire({
                title: 'Konfirmasi Hapus Permanen',
                text: 'Anda yakin ingin menghapus User ini secara permanen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Permanen',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus User...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                    });

                    $.ajax({
                        type: 'DELETE',
                        url: deleteForm.attr('action'),
                        data: deleteForm.serialize(),
                        success: function(response) {
                            Swal.close();

                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'User berhasil dihapus secara permanen.',
                                }).then(function() {
                                    // Refresh DataTable or redirect to another page
                                    $('#tableUsersTrashed').DataTable()
                                        .ajax.reload();
                                });
                            } else {
                                Swal.fire('Gagal',
                                    'Gagal menghapus User secara permanen',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus User secara permanen',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>
