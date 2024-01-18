@if (!$positions->trashed())
    <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-posisi" data-toggle="tooltip"
        data-placement="top" title="Detail Posisi" data-positions-id="{{ $positions->id }}">
        <i class="fas fa-eye"></i>
    </a>

    <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-posisi" data-placement="top"
        title="Edit Posisi" data-positions-id="{{ $positions->id }}">
        <i class="fas fa-edit"></i>
    </a>

    <form style="display: inline" action="{{ route('positions.destroy', $positions->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
            title="Hapus Posisi">
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endif

@if ($positions->trashed())
    <form style="display: inline" action="{{ route('position.restore', $positions->id) }}" method="POST"
        id="restoreFormPositions">
        @csrf
        <button type="submit" class="btn btn-sm btn-info restore-button-positions" data-toggle="tooltip"
            data-placement="top" title="Restore Posisi">
            <i class="fas fa-undo"></i>
        </button>

    </form>
    <form style="display: inline" action="{{ route('position.forceDelete', $positions->id) }}" method="POST"
        id="forceDeleteFormPositions">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-button-positions" data-toggle="tooltip"
            data-placement="top" title="Hapus Permanen Posisi">
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endif



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
                                    $('#tablePositions').DataTable().ajax
                                        .reload();

                                });
                                // Tambahkan kode lain yang sesuai, seperti memperbarui tampilan tabel.
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus periode',
                                    'error');
                            }
                        },
                        error: function() {
                            // Tutup pesan "loading"
                            Swal.close();

                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus periode',
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
        $('.restore-button-positions').on('click', function(e) {
            e.preventDefault();
            var restoreButton = $(this);
            var restoreForm = restoreButton.closest('#restoreFormPositions');

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

                                    $('#tablePositionsTrashed').DataTable()
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
        $('.delete-button-positions').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            var deleteForm = deleteButton.closest('#forceDeleteFormPositions');

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
                                    $('#tablePositionsTrashed').DataTable()
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
