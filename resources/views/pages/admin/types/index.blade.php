  @extends('layout.app')

  @section('content')
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Tipe</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                      <div class="breadcrumb-item">Tipe</div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Daftar Tipe Cuti</h2>


                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  @can('trashed types')
                                      <a class="btn btn-sm btn-danger float-left text-white" href="{{ route('type.trashed') }}"
                                          id="showDeletedButtonIntern"><i id="showDeletedIcon"
                                              class="fas fa-trash mr-2 color-white"></i> Data Terhapus</a>
                                  @endcan
                                  @can('create users')
                                      <div class="ml-auto">
                                          <button type="button" class="btn btn-sm btn-primary tombol-create"
                                              data-placement="top" id="btn-create" data-tooltip-toggle="tooltip"
                                              title="Tambah Data Tipe" data-toggle="modal" data-target="#modalCreateTypes">
                                              <i class="fas fa-plus mr-2"></i> Data Tipe
                                          </button>
                                      </div>
                                  @endcan


                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-striped" id="tableTypes">
                                          <thead>
                                              <tr>
                                                  <th class="table-fit">No</th>
                                                  <th>Tahun</th>
                                                  <th>Nama Tipe</th>
                                                  <th>Jumlah Cuti</th>
                                                  <th>Skala</th>
                                                  <th>Jumlah Hari</th>
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

      {{-- MODAL EDIT --}}
      @include('pages.admin.types.create')
      @include('pages.admin.types.show')
      @include('pages.admin.types.update')

      <script>
          $(document).ready(function() {

              var tableTypes = $('#tableTypes').DataTable({
                  processing: true,
                  serverSide: true,
                  // responsive: true,
                  ajax: {
                      url: "{{ route('types.index') }}"
                  },
                  columns: [{
                          data: 'DT_RowIndex',
                          name: 'DT_RowIndex',
                          orderable: false,
                          searchable: false,
                          class: 'table-fit'

                      },
                      {
                          data: 'created_at',
                          name: 'created_at',
                          render: function(data) {
                              var date = new Date(data);
                              var year = date.getFullYear();
                              return year;
                          }
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
                          className: 'text-capitalize'
                      },
                      {
                          data: 'duration_in_days',
                          name: 'duration_in_days',
                          render: function(data, type, row, meta) {
                                return data + ' Hari';
                            }

                          //   className: 'text-capitalize'
                      },
                      {
                          data: 'action',
                          name: 'action',
                          class: 'table-fit'

                      },


                  ]
              });
          });
      </script>

      <script>
          $(document).ready(function() {
              $("#formTypes").on("submit", function(e) {
                  e.preventDefault();
                  $('#modalCreateTypes').modal('hide');


                  Swal.fire({
                      title: 'Mohon Tunggu!',
                      html: 'Sedang memproses data...',
                      allowOutsideClick: false,
                      showConfirmButton: false,
                      willOpen: () => {
                          Swal.showLoading();
                      },
                  });

                  // Kirim data ke server menggunakan AJAX
                  $.ajax({
                      type: 'POST',
                      url: '{{ route('types.store') }}',
                      data: new FormData(this),
                      processData: false,
                      contentType: false,
                      success: function(response) {
                          Swal.close();

                          if (response.success) {

                              $('#formTypes')[0].reset();
                              $('#time').val('');
                              $('#time').selectric('refresh');
                              // Redirect ke halaman index dengan pesan "success"
                              Swal.fire({
                                  icon: 'success',
                                  title: 'Berhasil!',
                                  text: 'Data berhasil disimpan.',
                              }).then(function() {
                                  $('#tableTypes').DataTable().ajax.reload();
                              });
                          } else {
                              // Jika validasi gagal, tampilkan pesan-pesan kesalahan
                              if (response.errors) {
                                  var errorMessages = '';
                                  for (var key in response.errors) {
                                      if (response.errors.hasOwnProperty(key)) {
                                          errorMessages += response.errors[key][0] + '<br>';
                                      }
                                  }
                                  Swal.fire('Gagal', errorMessages, 'error');
                              } else {
                                  Swal.fire('Gagal', 'Terjadi kesalahan saat menyimpan data',
                                      'error');
                              }
                          }
                      },
                      error: function(xhr) {
                          Swal.close();
                          if (xhr.status === 422) {
                              // Menampilkan pesan validasi error SweetAlert
                              var errorMessages = '';
                              var errors = xhr.responseJSON.errors;
                              for (var key in errors) {
                                  if (errors.hasOwnProperty(key)) {
                                      errorMessages += errors[key][0] + '<br>';
                                  }
                              }
                              Swal.fire('Gagal', errorMessages, 'error');
                          } else {
                              Swal.fire('Gagal', 'Terjadi kesalahan saat simpan data.', 'error');
                          }
                      },
                  });
              });
          });
      </script>

      <script>
          $(document).ready(function() {
              $('#tableTypes').on('click', 'a.detail-tipe', function() {
                  var id = $(this).data('types-id');

                  $.ajax({
                      url: '{{ route('types.show', ':id') }}'.replace(':id', id),
                      type: 'GET',
                      success: function(response) {
                          $('#modalDetailTypes').modal('show');
                          $('#id').val(response.result.id);
                          $('#name_detail').val(response.result.name);
                          $('#duration_detail').val(response.result.duration);
                        //   $('#duration_in_days_detail').val(response.result.duration_in_days);
                          $('#time_detail').val(response.result.time);
                          //   $('#time_detail').selectric('refresh');

                      },
                      error: function(xhr) {
                          console.log(xhr.responseText);
                      }
                  });
              });
          });
      </script>

      <script>
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $(document).ready(function() {
              $('#tableTypes').on('click', 'a.edit-tipe', function() {
                  var id = $(this).data('types-id');
                  console.log(id);

                  $.ajax({
                      url: '{{ route('types.edit', ':id') }}'.replace(':id', id),
                      type: 'GET',
                      success: function(response) {
                          $('#modalEditTypes').modal('show');
                          $('#type_id').val(response.result.id);
                          $('#name_edit').val(response.result.name);
                          $('#duration_edit').val(response.result.duration);
                          $('#time_edit').val(response.result.time);
                        //   $('#duration_in_days_edit').val(response.result.duration_in_days);
                          $('#time_edit').selectric('refresh');

                      },
                      error: function(xhr) {
                          console.log(xhr.responseText);
                      }
                  });
              });
          });
          

          $(document).on('click', '.btn-update', function(e) {

              let typeId = $('#type_id').val();
              var var_url = '{{ route('types.update', ':typeId') }}'.replace(':typeId', typeId);
              var var_type = 'PUT';
              $.ajax({
                  url: var_url,
                  type: var_type,
                  data: {
                      "_token": "{{ csrf_token() }}",

                      name: $('#name_edit').val(),
                      duration: $('#duration_edit').val(),
                      time: $('#time_edit').val(),
                    //   duration_in_days: $('#duration_in_days_edit').val(),

                  },
                  success: function(response) {
                      if (response.errors) {
                          console.log(response.errors);

                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal!',
                          });


                      } else {
                          Swal.fire({
                              icon: 'success',
                              title: 'Berhasil!',
                              text: 'Data berhasil diupdate.',
                          });

                          $('#tableTypes').DataTable().ajax.reload(null, false);

                          $('#modalEditTypes').modal('hide');

                      }
                  },
                  error: function(xhr) {
                      if (xhr.status === 422) {
                          // Menampilkan pesan validasi error SweetAlert
                          var errorMessages = '';
                          var errors = xhr.responseJSON.errors;
                          for (var key in errors) {
                              if (errors.hasOwnProperty(key)) {
                                  errorMessages += errors[key][0] + '<br>';
                              }
                          }

                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal!',
                              html: errorMessages,
                          });

                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Gagal!',
                              text: 'Terjadi kesalahan saat update data.',
                          });
                      }
                  },
              });
              // }
          });
      </script>
  @endsection
