@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{route('divisions.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                  </div>
                  <h1>Divisions Terhapus</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="/">Dasboard</a></div>
                    <div class="breadcrumb-item "><a href="{{ route('divisions.index') }}">Divisions</a></div>
                    <div class="breadcrumb-item active">Divisions Terhapus</div>
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
                                    <table class="table table-striped" id="tableDivisionsTrashed">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Divisi</th>
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

    @push('script-divisions-trashed')
        <script>
            $(document).ready(function() {
                var tableDivisionsTrashed = $('#tableDivisionsTrashed').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('division.trashed') }}",
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
