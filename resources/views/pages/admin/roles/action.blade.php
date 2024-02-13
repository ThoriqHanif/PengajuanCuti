    @can('show roles')
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-posisi" data-toggle="tooltip"
            data-placement="top" title="Detail Posisi" data-roles-id="{{ $roles->id }}"
            href="{{ route('roles.show', $roles->id) }}">
            <i class="fas fa-eye"></i>
        </a>
    @endcan

    @can('edit roles')
        <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-posisi" data-placement="top"
            title="Edit Posisi" data-roles-id="{{ $roles->id }}" href="{{ route('roles.edit', $roles->id) }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan


    @can('delete roles')
        <form style="display: inline" action="{{ route('roles.destroy', $roles->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
                title="Hapus Posisi">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan





    <script>
        $(document).ready(function() {
            // Memberikan event handler untuk tombol hapus
            $('.delete-button').on('click', function(e) {
                e.preventDefault();
                var deleteButton = $(this);
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Anda yakin ingin menghapus posisi ini?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Mohon Tunggu!',
                            html: 'Sedang menghapus Posisi...',
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
                                        text: 'Data posisi berhasil dihapus.',
                                    }).then(function() {
                                        $('#tableRoles').DataTable().ajax
                                            .reload();

                                    });
                                    // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                                } else {
                                    Swal.fire('Gagal', 'Gagal menghapus Role',
                                        'error');
                                }
                            },
                            error: function() {
                                // Tutup pesan "loading"
                                Swal.close();

                                Swal.fire('Gagal',
                                    'Terjadi kesalahan saat menghapus Role',
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
            $('.restore-button-roles').on('click', function(e) {
                e.preventDefault();
                var restoreButton = $(this);
                var restoreForm = restoreButton.closest('#restoreFormroles');

                Swal.fire({
                    title: 'Konfirmasi Restore',
                    text: 'Anda yakin ingin mengembalikan Posisi ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Restore',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Mohon Tunggu!',
                            html: 'Sedang mengembalikan Posisi...',
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
                                        text: 'Posisi berhasil di-restore.',
                                    }).then(function() {

                                        $('#tablerolesTrashed').DataTable()
                                            .ajax.reload();

                                    });
                                } else {
                                    Swal.fire('Gagal', 'Gagal mengembalikan Posisi',
                                        'error');
                                }
                            },
                            error: function() {
                                Swal.close();
                                Swal.fire('Gagal',
                                    'Terjadi kesalahan saat mengembalikan Posisi',
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
            $('.delete-button-roles').on('click', function(e) {
                e.preventDefault();
                var deleteButton = $(this);
                var deleteForm = deleteButton.closest('#forceDeleteFormroles');

                Swal.fire({
                    title: 'Konfirmasi Hapus Permanen',
                    text: 'Anda yakin ingin menghapus Posisi ini secara permanen?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus Permanen',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Mohon Tunggu!',
                            html: 'Sedang menghapus Posisi...',
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
                                        text: 'Posisi berhasil dihapus secara permanen.',
                                    }).then(function() {
                                        // Refresh DataTable or redirect to another page
                                        $('#tablerolesTrashed').DataTable()
                                            .ajax.reload();
                                    });
                                } else {
                                    Swal.fire('Gagal',
                                        'Gagal menghapus Posisi secara permanen',
                                        'error');
                                }
                            },
                            error: function() {
                                Swal.close();
                                Swal.fire('Gagal',
                                    'Terjadi kesalahan saat menghapus Posisi secara permanen',
                                    'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
