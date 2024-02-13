@if (!$types->trashed())
    @can('show types')
        <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-tipe" data-toggle="tooltip"
            data-placement="top" title="Detail Tipe" data-types-id="{{ $types->id }}">
            <i class="fas fa-eye"></i>
        </a>
    @endcan

    @can('edit types')
        <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-tipe" data-placement="top" title="Edit Tipe"
            data-types-id="{{ $types->id }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan

    @can('delete types')
        <form style="display: inline" action="{{ route('types.destroy', $types->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
                title="Hapus Tipe">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
@endif

@if ($types->trashed())
    @can('restore types')
        <form style="display: inline" action="{{ route('type.restore', $types->id) }}" method="POST" id="restoreFormTypes">
            @csrf
            <button type="submit" class="btn btn-sm btn-info restore-button-types" data-toggle="tooltip"
                data-placement="top" title="Restore Tipe">
                <i class="fas fa-undo"></i>
            </button>

        </form>
    @endcan

    @can('force-delete types')
        <form style="display: inline" action="{{ route('type.forceDelete', $types->id) }}" method="POST"
            id="forceDeleteFormTypes">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-button-types" data-toggle="tooltip"
                data-placement="top" title="Hapus Permanen Tipe">
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
                text: 'Anda yakin ingin menghapus Tipe ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus Tipe...',
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
                                    text: 'Data Tipe berhasil dihapus.',
                                }).then(function() {
                                    $('#tableTypes').DataTable().ajax
                                        .reload();

                                });
                                // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus Tipe Cuti',
                                    'error');
                            }
                        },
                        error: function() {
                            // Tutup pesan "loading"
                            Swal.close();

                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus Tipe Cuti',
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
        $('.restore-button-types').on('click', function(e) {
            e.preventDefault();
            var restoreButton = $(this);
            var restoreForm = restoreButton.closest('#restoreFormTypes');

            Swal.fire({
                title: 'Konfirmasi Restore',
                text: 'Anda yakin ingin mengembalikan Tipe ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Restore',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang mengembalikan Tipe...',
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
                                    text: 'Tipe berhasil di-restore.',
                                }).then(function() {

                                    $('#tableTypesTrashed').DataTable().ajax
                                        .reload();

                                });
                            } else {
                                Swal.fire('Gagal', 'Gagal mengembalikan Tipe',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat mengembalikan Tipe',
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
        $('.delete-button-types').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            var deleteForm = deleteButton.closest('#forceDeleteFormTypes');

            Swal.fire({
                title: 'Konfirmasi Hapus Permanen',
                text: 'Anda yakin ingin menghapus Tipe ini secara permanen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Permanen',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus Tipe...',
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
                                    text: 'Tipe berhasil dihapus secara permanen.',
                                }).then(function() {
                                    // Refresh DataTable or redirect to another page
                                    $('#tableTypesTrashed').DataTable()
                                        .ajax.reload();
                                });
                            } else {
                                Swal.fire('Gagal',
                                    'Gagal menghapus Tipe secara permanen',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus Tipe secara permanen',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>
