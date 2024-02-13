@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    <a href="{{ route('leaves.index') }}" class="btn btn-icon"><i
                            class="fas fa-arrow-left align-items-center mb-2"></i></a>
                    Pengajuan Terhapus
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item "><a href="/">Dasboard</a></div>
                    <div class="breadcrumb-item "><a href="{{ route('leaves.index') }}">Leaves</a></div>
                    <div class="breadcrumb-item active">Pengajuan Terhapus</div>
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
                                {{-- <div class="table-responsive"> --}}
                                    <table class="table table-striped" id="tableLeavesTrashed">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                  <th>Kode Cuti</th>
                                                  <th>Nama</th>
                                                  <th>Tipe</th>
                                                  <th>Tanggal Pengajuan</th>
                                                  <th>Tanggal Mulai</th>
                                                  <th>Tanggal Selesai</th>
                                                  <th>Lama</th>
                                                  <th>Alasan</th>
                                                  <th>Status Manager</th>
                                                  <th>Status COO</th>
                                                  <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>


                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @push('script-leaves-trashed')
        <script>
            $(document).ready(function() {
                var tableLeavesTrashed = $('#tableLeavesTrashed').DataTable({
                    processing: true,
                      serverSide: true,
                      responsive: true,
                      ajax: {
                          url: "{{ route('leave.trashed') }}"
                      },
                      columns: [{
                              data: 'DT_RowIndex',
                              name: 'DT_RowIndex',
                              orderable: false,
                              searchable: false,
                              class: 'table-fit',

                          },
                          {
                              data: 'code',
                              name: 'code',
                              class: 'table-fit',
                          },
                          {
                              data: 'user.full_name',
                              name: 'user.full_name',
                              class: 'table-fit',
                          },
                          {
                              data: 'type.name',
                              name: 'type.name',
                              class: 'table-fit',
                          },
                          {
                              data: 'created_at',
                              name: 'created_at',
                              class: 'table-fit',
                              render: function(data, type, row) {
                                  // Konversi format tanggal ke bahasa Indonesia
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
                              data: 'start_date',
                              name: 'start_date',
                              class: 'table-fit',
                              render: function(data, type, row) {
                                  // Konversi format tanggal ke bahasa Indonesia
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
                                  // Konversi format tanggal ke bahasa Indonesia
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
                              data: 'duration',
                              name: 'duration',
                              render: function(data, type, row) {
                                  return data + ' hari';
                              }
                          },
                          {
                              data: 'reason',
                              name: 'reason',
                              class: 'table-fit',
                          },
                          {
                              data: 'status_manager',
                              name: 'status_manager',
                              class: 'table-fit',
                              render: function(data, type, row) {
                                  if (type === 'display') {
                                      var badgeClass = '';
                                      var statusText = '';

                                      switch (data) {
                                          case 0:
                                              badgeClass = 'badge-warning';
                                              statusText = 'Pending';
                                              break;
                                          case 1:
                                              badgeClass = 'badge-info';
                                              statusText = 'Sedang direview';
                                              break;
                                          case 2:
                                              badgeClass = 'badge-success';
                                              statusText = 'Disetujui';
                                              break;
                                          case 3:
                                              badgeClass = 'badge-danger';
                                              statusText = 'Ditolak';
                                              break;
                                          default:
                                              badgeClass = '';
                                              statusText = '';
                                              break;
                                      }

                                      return '<span class="badge ' + badgeClass + '">' + statusText +
                                          '</span>';
                                  }

                                  return data;
                              }
                          },
                          {
                              data: 'status_coo',
                              name: 'status_coo',
                              class: 'table-fit',
                              render: function(data, type, row) {
                                  if (type === 'display') {
                                      var badgeClass = '';
                                      var statusText = '';

                                      switch (data) {
                                          case 0:
                                              badgeClass = 'badge-warning';
                                              statusText = 'Pending';
                                              break;
                                          case 1:
                                              badgeClass = 'badge-info';
                                              statusText = 'Sedang direview';
                                              break;
                                          case 2:
                                              badgeClass = 'badge-success';
                                              statusText = 'Disetujui';
                                              break;
                                          case 3:
                                              badgeClass = 'badge-danger';
                                              statusText = 'Ditolak';
                                              break;
                                          default:
                                              badgeClass = '';
                                              statusText = '';
                                              break;
                                      }

                                      return '<span class="badge ' + badgeClass + '">' + statusText +
                                          '</span>';
                                  }

                                  return data;
                              }
                          },

                          {
                              data: 'action',
                              name: 'action',
                              class: 'table-fit',
                          },


                      ],
                      columnDefs: [{
                          targets: -1,
                          responsivePriority: 1
                      }]
                  });
              });
        </script>
    @endpush
@endsection
