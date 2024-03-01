@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Laporan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Laporan</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="section-title">Filter</h2>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Tahun Pengajuan</label>
                                        <input type="text" class="form-control" name="filterTahun" id="filterTahun" />
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Bulan Pengajuan</label>
                                        <input type="text" class="form-control" name="filterBulan" id="filterBulan"
                                            placeholder="Pilih Bulan" />
                                    </div>
                                    @if (auth()->user()->position->level == 1)
                                        <div class="col-md-3">
                                            <label for="">Divisi Pengajuan</label>
                                            <select name="" id="filterDivisi" class="form-control selectric">
                                                <option value="">All</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">
                                                        {{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col-md-3">
                                        <label for="">Status Pengajuan</label>
                                        <select name="filterStatus" id="filterStatus" class="form-control selectric">
                                            <option value="">All</option>
                                            <option value="2">Diterima</option>
                                            <option value="3">Ditolak</option>
                                            <option value="1">Direview</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="reset">Reset</button>
                                {{-- <button class="btn btn-primary mr-1 tombol-cari"><i class="fas fa-search mr-1"></i> Cari
                                    Pengajuan</button> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="section-title">Daftar Laporan</h2>
                                <div class="ml-auto">
                                    <a href="{{ route('export.report') }}" class="btn btn-sm btn-primary tombol-export" data-placement="top"
                                        id="btn-create" data-tooltip-toggle="tooltip" title="Tambah Data Divisi">
                                        <i class="fas fa-file-export mr-2"></i> Export Excel
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-xl" id="tableReport">
                                        <thead>
                                            <tr>
                                                <th class="table-fit">No</th>
                                                <th class="table-fit">Tahun</th>
                                                <th class="table-fit">Bulan</th>
                                                <th>Divisi</th>
                                                <th>Nama</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Tipe Cuti</th>
                                                <th>Alasan</th>
                                                <th class="table-fit">Status</th>
                                                {{-- <th class="table-fit">Action</th> --}}
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

    {{-- // paging: false,
    // scrollCollapse: true,
    // scrollX: true,
    // scrollY: 300,

    // fixedColumns: {
    //     leftColumns: 3, // Menetapkan dua kolom di awal tabel
    //     rightColumns: 1 // Tetapkan 1 kolom di akhir tabel
    // }, --}}


    @push('script-report')
        <script>
            $(document).ready(function() {
                var currentYear = new Date().getFullYear();
                $('#filterTahun').val(currentYear);

                var tableReport = $('#tableReport').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    order: [
                        [5, 'asc']
                    ],
                    ajax: {
                        url: "{{ route('report') }}",
                        data: function(d) {
                            d.filterTahun = $('#filterTahun').val();
                            d.filterStatus = $('#filterStatus').val();
                            d.filterBulan = $('#filterBulan').val();
                            d.filterDivisi = $('#filterDivisi').val();
                        }

                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false,
                            class: 'table-fit'

                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            class: 'bold table-fit',
                            render: function(data, type, row) {
                                let startDate = new Date(data);
                                return startDate.toLocaleDateString('id-ID', {
                                    year: 'numeric',
                                });
                            }
                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            class: 'bold table-fit',

                            render: function(data, type, row) {
                                // Konversi format tanggal ke bahasa Indonesia
                                let startDate = new Date(data);
                                return startDate.toLocaleDateString('id-ID', {
                                    month: 'long',
                                });
                            }
                        },
                        {
                            data: 'user.division.name',
                            name: 'user.division.name',
                            class: 'table-fit'
                        },
                        {
                            data: 'user.full_name',
                            name: 'user.full_name',
                            class: 'table-fit'

                        },
                        {
                            data: 'start_date',
                            name: 'start_date',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                let startDate = new Date(data);
                                return startDate.toLocaleDateString('id-ID', {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                            }
                        },
                        {
                            data: 'end_date',
                            name: 'end_date',
                            class: 'table-fit',
                            render: function(data, type, row) {
                                let startDate = new Date(data);
                                return startDate.toLocaleDateString('id-ID', {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                            }
                        },
                        {
                            data: 'type.name',
                            name: 'type.name',
                            class: 'table-fit'

                        },
                        {
                            data: 'reason',
                            name: 'reason',
                            class: 'table-fit'

                        },
                        {
                            data: 'status_coo',
                            name: 'status_coo',
                            class: 'bold table-fit',
                            render: function(data, type, row) {
                                var statusText = '';
                                var badgeClass = '';

                                switch (data) {
                                    case 0:
                                        statusText = 'Pending';
                                        badgeClass = 'badge-warning';
                                        break;
                                    case 1:
                                        statusText = 'Sedang Direview';
                                        badgeClass = 'badge-info';
                                        break;
                                    case 2:
                                        statusText = 'Diterima';
                                        badgeClass = 'badge-success';
                                        break;
                                    case 3:
                                        statusText = 'Ditolak';
                                        badgeClass = 'badge-danger';
                                        break;
                                    default:
                                        statusText = 'Unknown';
                                        badgeClass = 'badge-secondary';
                                }

                                return '<span class="badge ' + badgeClass + '">' + statusText +
                                    '</span>';
                            }

                        },


                    ]
                });
                $('.tombol-cari').on('click', function() {
                    tableReport.ajax.reload(); 
                });

                $('#filterStatus').change(function() {
                    tableReport.ajax.reload(); 
                });
                $('#filterDivisi').change(function() {
                    var selectedDivision = $(this).val();
                    tableReport.ajax.reload(); 
                });
                $('#filterTahun').change(function() {
                    tableReport.ajax.reload(); 
                });
                $('#filterBulan').change(function() {
                    tableReport.ajax.reload(); 
                });

            });
        </script>
        <script>
            $(document).ready(function() {

                var currentYear = new Date().getFullYear();
                $('#filterTahun').val(currentYear);

                $('#filterTahun').datepicker({
                    format: "yyyy",
                    viewMode: "years",
                    minViewMode: "years",
                    autoclose: true
                });

                $('#filterBulan').datepicker({
                    format: "mm",
                    startView: "year",
                    minViewMode: "months",
                    autoclose: true,
                    language: "id"
                });
                

                $('#filterTahun').on('changeDate', function(e) {
                    var selectedYear = e.date.getFullYear();
                    $('#filterBulan').datepicker('update', new Date(selectedYear, 0, 1));
                    $('#filterBulan').val('');

                });
            });
        </script>
    @endpush
@endsection
