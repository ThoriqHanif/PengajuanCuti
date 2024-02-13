  @extends('layout.app')

  @section('content')
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Leaves</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasboard</a></div>
                      <div class="breadcrumb-item">Leaves</div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Daftar Pengajuan Cuti</h2>


                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">

                                  <a class="btn btn-sm btn-danger float-left text-white" href="{{ route('leave.trashed') }}"
                                      id="showDeletedButtonIntern"><i id="showDeletedIcon"
                                          class="fas fa-trash mr-2 color-white"></i> Data Terhapus</a>
                                  <div class="ml-auto">
                                      <a href="{{ route('leaves.create') }}" class="btn btn-sm btn-primary tombol-export"
                                          data-placement="top" id="btn-export" data-toggle="tooltip"
                                          title="Tambah Pengajuan Cuti">
                                          <i class="fas fa-plus mr-2"></i> Pengajuan
                                      </a>
                                  </div>

                              </div>
                              <div class="card-body">
                                  {{-- <div class="table-responsive"> --}}
                                  <table class="table table-striped" id="tableLeaves">
                                      <thead>
                                          <tr>
                                              <th>No</th>
                                              <th>Kode Cuti</th>
                                              <th>Nama</th>
                                              <th>Tipe</th>
                                              <th>Tanggal Pengajuan</th>
                                              <th>Tanggal Mulai</th>
                                              <th>Tanggal Selesai</th>
                                              <th>Status Manager</th>
                                              <th>Status COO</th>
                                              <th>Lama</th>
                                              <th>Alasan</th>
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


      {{-- @include('pages.admin.positions.create')
      @include('pages.admin.positions.show')
      @include('pages.admin.positions.update') --}}

      {{-- MODAL EDIT --}}


      @push('script-leaves')
          <script>
              $(document).ready(function() {

                  var tableLeaves = $('#tableLeaves').DataTable({
                      processing: true,
                      serverSide: true,
                      responsive: true,
                      ajax: {
                          url: "{{ route('leaves.index') }}"
                      },
                      columns: [{
                              data: 'DT_RowIndex',
                              name: 'DT_RowIndex',
                              orderable: false,
                              searchable: false,
                              class: 'table-fit'

                          },
                          {
                              data: 'code',
                              name: 'code',
                              class: 'table-fit'
                          },
                          {
                              data: 'user.full_name',
                              name: 'user.full_name',
                              class: 'table-fit'
                          },
                          {
                              data: 'type.name',
                              name: 'type.name',
                              class: 'table-fit'
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
                                              statusText = 'Sedang Direview';
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
                                              statusText = 'Sedang Direview';
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

          <script>
              function showAlert(message, type) {
                  Swal.fire({
                      icon: type,
                      title: 'Peringatan',
                      text: message,
                  });
              }

              // Fungsi untuk menangani perubahan pada input duration
              function checkDuration() {
                  var selectedTypeId = $("#type_id").val();
                  var inputDuration = parseInt($("#duration").val());

                  // Lakukan request Ajax ke server untuk mendapatkan duration dari jenis cuti yang dipilih
                  $.ajax({
                      url: '/get-duration/' + selectedTypeId, // Gantilah dengan URL yang sesuai di aplikasi Anda
                      type: 'GET',
                      success: function(response) {
                          var maxDuration = response.duration;

                          // Cek apakah input duration melebihi batas
                          if (inputDuration > maxDuration) {
                              showAlert('Tidak Boleh Melebihi batas cuti', 'error');
                              $("#duration").val(''); // Reset input duration
                          }
                      },
                      error: function(error) {
                          console.log(error);
                      }
                  });
              }

              // Panggil fungsi checkDuration saat nilai input duration berubah
              $("#duration").on('input', function() {
                  checkDuration();
              });
          </script>
      @endpush
  @endsection
