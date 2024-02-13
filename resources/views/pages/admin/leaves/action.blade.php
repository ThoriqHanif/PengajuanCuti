@if (!$leaves->trashed())
    <a class="btn btn-sm bg-primary text-white font-weight-bold text-xs detail-user" data-toggle="tooltip"
        data-placement="top" title="Detail Leaves" data-leaves-id="{{ $leaves->slug }}"
        href="{{ route('leaves.show', $leaves->slug) }}">
        <i class="fas fa-eye"></i>
    </a>

    @if ($leaves->status_manager == 0)
        <a class="btn btn-sm bg-warning text-white font-weight-bold text-xs edit-user" data-placement="top"
            id="btn-edit-user" title="Edit User" data-leaves-id="{{ $leaves->slug }}"
            href="{{ route('leaves.edit', $leaves->slug) }}">
            <i class="fas fa-edit"></i>
        </a>
    @endif
    @if ($leaves->status_manager == 0)
        <form style="display: inline" action="{{ route('leaves.destroy', $leaves->slug) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-button" data-toggle="tooltip"
                data-placement="top" title="Hapus User">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endif
@endif

@if ($leaves->trashed())
    <form style="display: inline" action="{{ route('leave.restore', $leaves->slug) }}" method="POST"
        id="restoreFormLeaves">
        @csrf
        <button type="submit" class="btn btn-sm btn-info restore-button-leaves" data-toggle="tooltip"
            data-placement="top" title="Restore Pengajuan">
            <i class="fas fa-undo"></i>
        </button>

    </form>
    <form style="display: inline" action="{{ route('leave.forceDelete', $leaves->slug) }}" method="POST"
        id="forceDeleteFormLeaves">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger delete-button-leaves" data-toggle="tooltip"
            data-placement="top" title="Hapus Permanen Pengajuan">
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
                text: 'Anda yakin ingin menghapus Pengajuan ini?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus Pengajuan...',
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
                                    $('#tableLeaves').DataTable().ajax
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
        $('.restore-button-leaves').on('click', function(e) {
            e.preventDefault();
            var restoreButton = $(this);
            var restoreForm = restoreButton.closest('#restoreFormLeaves');

            Swal.fire({
                title: 'Konfirmasi Restore',
                text: 'Anda yakin ingin mengembalikan Pengajuan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Restore',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang mengembalikan Pengajuan...',
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
                                    text: 'Pengajuan berhasil di-restore.',
                                }).then(function() {

                                    $('#tableLeavesTrashed').DataTable()
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
        $('.delete-button-leaves').on('click', function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            var deleteForm = deleteButton.closest('#forceDeleteFormLeaves');

            Swal.fire({
                title: 'Konfirmasi Hapus Permanen',
                text: 'Anda yakin ingin menghapus Pengajuan ini secara permanen?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus Permanen',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Mohon Tunggu!',
                        html: 'Sedang menghapus Pengajuan...',
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
                                    text: 'Pengajuan berhasil dihapus secara permanen.',
                                }).then(function() {
                                    // Refresh DataTable or redirect to another page
                                    $('#tableLeavesTrashed').DataTable()
                                        .ajax.reload();
                                });
                            } else {
                                Swal.fire('Gagal',
                                    'Gagal menghapus Pengajuan secara permanen',
                                    'error');
                            }
                        },
                        error: function() {
                            Swal.close();
                            Swal.fire('Gagal',
                                'Terjadi kesalahan saat menghapus Pengajuan secara permanen',
                                'error');
                        }
                    });
                }
            });
        });
    });
</script>
