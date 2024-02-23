@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('types.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Tipe Terhapus</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="/">Dasboard</a></div>
                    <div class="breadcrumb-item "><a href="{{ route('types.index') }}">Types</a></div>
                    <div class="breadcrumb-item active">Types Terhapus</div>
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
                                    <table class="table table-striped" id="tableTypesTrashed">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Divisi</th>
                                                <th>Jumlah Cuti</th>
                                                <th>Skala</th>
                                                <th>Total Hari</th>
                                                <th>Tanggal Dihapus</th>
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

    @push('script-types-trashed')
        <script>
            $(document).ready(function() {
                var tableTypesTrashed = $('#tableTypesTrashed').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('type.trashed') }}",
                    },
                    columns: [

                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,

                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'duration',
                            name: 'duration'
                        },
                        {
                            data: 'time',
                            name: 'time',
                            class: 'text-capitalize'
                        },
                        {
                            data: 'duration_in_days',
                            name: 'duration_in_days',
                            render: function(data, type, row, meta) {
                                return data + ' Hari';
                            }

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
