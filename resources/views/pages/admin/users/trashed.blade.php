@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    <a href="{{ route('users.index') }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left align-items-center mb-2"></i></a>
                    Users Terhapus
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="/">Dasboard</a></div>
                    <div class="breadcrumb-item "><a href="{{ route('users.index') }}">Users</a></div>
                    <div class="breadcrumb-item active">User Terhapus</div>
                </div>
            </div>

            <div class="section-body">


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                    <h2 class="section-title">Divisions</h2>

                                </div> --}}
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="tableUsersTrashed">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Lengkap</th>
                                                <th>Telephone</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Divisi</th>
                                                <th>Posisi</th>
                                                <th>Manager</th>
                                                <th>Role</th>
                                                <th>Tanggal dihapus</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @push('script-users-trashed')
        <script>
            $(document).ready(function() {
                var tableUsersTrashed = $('#tableUsersTrashed').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('user.trashed') }}",
                    },
                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,

                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'telp',
                            name: 'telp'
                        },
                        {
                            data: 'entry_date',
                            name: 'entry_date'
                        },
                        {
                            data: 'division.name',
                            name: 'division.name',
                            render: function(data, type, full, meta) {
                                  return data || '<p>-</p>';
                              },
                              className: 'text-center'
                        },
                        {
                            data: 'position.name',
                            name: 'position.name'
                        },
                        {
                            data: 'manager_name',
                            name: 'manager_name',
                            render: function(data, type, full, meta) {
                                return data || '<p>-</p>';
                            },
                            className: 'text-center'
                        },
                        {
                            data: 'role.name',
                            name: 'role.name'
                        },
                        {
                            data: 'deleted_at',
                            name: 'deleted_at',
                            render: function(data, type, row) {
                                let dateReport = new Date(data);
                                return dateReport.toLocaleDateString(
                                    'id-ID', {
                                        weekday: 'long',
                                        year: 'numeric',
                                        month: 'long',
                                        day: 'numeric',
                                        hour: 'numeric',
                                        minute: 'numeric',
                                        second: 'numeric'
                                    });
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                        },
                    ]

                });
            });
        </script>
    @endpush
@endsection
