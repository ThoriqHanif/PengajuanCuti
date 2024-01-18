@if (!$divisions->trashed())
    <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-divisi" data-toggle="tooltip"
        data-placement="top" title="Detail Divisi" data-divisions-id="{{ $divisions->id }}">
        <i class="fas fa-eye"></i>
    </a>

    <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-divisi" data-placement="top"
        title="Edit Divisi" data-divisions-id="{{ $divisions->id }}">
        <i class="fas fa-edit"></i>
    </a>

    <form style="display: inline" action="{{ route('divisions.destroy', $divisions->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip" data-placement="top"
            title="Hapus Divisi">
            <i class="fas fa-trash"></i>
        </button>
    </form>
@endif

@if ($divisions->trashed())
    <form style="display: inline" action="{{ route('division.restore', $divisions->id) }}" method="POST"
        id="restoreFormDivisions">
        @csrf
        <button type="submit" class="btn btn-sm btn-info restore-button-divisions" data-toggle="tooltip"
            data-placement="top" title="Restore Divisi">
            <i class="fas fa-undo"></i>
        </button>

    </form>
    <form style="display: inline" action="{{ route('division.forceDelete', $divisions->id) }}" method="POST"
        id="forceDeleteFormDivisions">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-button-divisions" data-toggle="tooltip"
            data-placement="top" title="Hapus Permanen Divisi">
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
                text: 'Anda yakin ingin menghapus divisi ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus divisi...',
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
                                    text: 'Data divisi berhasil dihapus.',
                                }).then(function() {
                                    $('#tableDivisions').DataTable().ajax
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
        $('.restore-button-divisions').on('click', function(e) {
            e.preventDefault();
            var restoreButton = $(this);
            var restoreForm = restoreButton.closest('#restoreFormDivisions');

            Swal.fire({
                title: 'Konfirmasi Restore',
                text: 'Anda yakin ingin mengembalikan Divisi ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Restore',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang mengembalikan Divisi...',
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
                                    text: 'Divisi berhasil di-restore.',
                                }).then(function() {

                                    $('#tableDivisionsTrashed').DataTable()
                                        .ajax.reload();

                                });
                            } else {
                                Swal.fire('Gagal', 'Gagal mengembalikan Divisi',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat mengembalikan Divisi',
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
        $('.delete-button-divisions').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            var deleteForm = deleteButton.closest('#forceDeleteFormDivisions');

            Swal.fire({
                title: 'Konfirmasi Hapus Permanen',
                text: 'Anda yakin ingin menghapus Divisi ini secara permanen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Permanen',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus Divisi...',
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
                                    text: 'Divisi berhasil dihapus secara permanen.',
                                }).then(function() {
                                    // Refresh DataTable or redirect to another page
                                    $('#tableDivisionsTrashed').DataTable()
                                        .ajax.reload();
                                });
                            } else {
                                Swal.fire('Gagal',
                                    'Gagal menghapus Divisi secara permanen',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus Divisi secara permanen',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>
