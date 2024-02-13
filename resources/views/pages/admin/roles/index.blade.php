  @extends('layout.app')

  @section('content')
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Roles</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasboard</a></div>
                      <div class="breadcrumb-item">Roles</div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Roles</h2>


                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  {{-- <a class="btn btn-sm btn-danger float-left text-white" href="{{route('role.trashed')}}"
                                      id="showDeletedButtonIntern"><i id="showDeletedIcon"
                                          class="fas fa-trash mr-2 color-white"></i> Lihat Data Terhapus</a> --}}
                                  @can('create roles')
                                      <div class="ml-auto">
                                          <a href="{{ route('roles.create') }}" class="btn btn-sm btn-primary tombol-create"
                                              data-placement="top" id="btn-create" data-toggle="tooltip"
                                              title="Tambah Data Roles">
                                              <i class="fas fa-plus mr-2"></i> Data Roles
                                          </a>
                                      </div>
                                  @endcan

                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-striped" id="tableRoles">
                                          <thead>
                                              <tr>
                                                  <th class="table-fit">No</th>
                                                  <th>Nama Role</th>
                                                  <th class="table-fit">Action</th>
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


      {{-- @include('pages.admin.positions.create')
      @include('pages.admin.positions.show')
      @include('pages.admin.positions.update') --}}

      {{-- MODAL EDIT --}}


      @push('script-roles')
          <script>
              $(document).ready(function() {

                  var tableRoles = $('#tableRoles').DataTable({
                      processing: true,
                      serverSide: true,
                      // responsive: true,
                      ajax: {
                          url: "{{ route('roles.index') }}"
                      },
                      columns: [{
                              data: 'DT_RowIndex',
                              name: 'DT_RowIndex',
                              orderable: false,
                              searchable: false,
                              class: 'table-fit'

                          },
                          {
                              data: 'name',
                              name: 'name'
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

          {{-- <script>
              $(document).ready(function() {
                  $("#formPositions").on("submit", function(e) {
                      e.preventDefault();
                      $('#modalCreatePosisi').modal('hide');


                      Swal.fire({
                          title: 'Mohon Tunggu!',
                          html: 'Sedang memproses data...',
                          allowOutsideClick: false,
                          showConfirmButton: false,
                          willOpen: () => {
                              Swal.showLoading();
                          },
                      });

                      // var submitButton = $(".btn-simpan");
                      // submitButton.addClass("btn-progress");

                      // Kirim data ke server menggunakan AJAX
                      $.ajax({
                          type: 'POST',
                          url: '{{ route('positions.store') }}',
                          data: new FormData(this),
                          processData: false,
                          contentType: false,
                          success: function(response) {
                              Swal.close();

                              // submitButton.removeClass("btn-progress");
                              // $('#modalCreateDivisi').modal('hide');

                              if (response.success) {
                                  $('#formPositions')[0].reset();
                                  // Redirect ke halaman index dengan pesan "success"
                                  Swal.fire({
                                      icon: 'success',
                                      title: 'Berhasil!',
                                      text: 'Data berhasil disimpan.',
                                  }).then(function() {
                                      // Redirect ke halaman indeks setelah menutup SweetAlert
                                      // window.location.href =
                                      // '{{ route('divisions.index') }}';
                                      $('#tablePositions').DataTable().ajax.reload();
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
                                      Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data',
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
                                  Swal.fire('Gagal', 'Terjadi kesalahan saat update data.', 'error');
                              }
                          },
                      });
                  });
              });
          </script> --}}

          {{-- <script>
              $(document).ready(function() {
                  $('#tablePositions').on('click', 'a.detail-posisi', function() {
                      var id = $(this).data('positions-id');

                      $.ajax({
                          url: '{{ route('positions.show', ':id') }}'.replace(':id', id),
                          type: 'GET',
                          success: function(response) {
                              $('#modalDetailPosisi').modal('show');
                              $('#id').val(response.result.id);
                              $('#name_detail').val(response.result.name);
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
                  $('#tablePositions').on('click', 'a.edit-posisi', function() {
                      var id = $(this).data('positions-id');
                      console.log(id);

                      $.ajax({
                          url: '{{ route('positions.edit', ':id') }}'.replace(':id', id),
                          type: 'GET',
                          success: function(response) {
                              $('#modalEditPosisi').modal('show');
                              $('#position_id').val(response.result.id);
                              $('#name_edit').val(response.result.name);
                          },
                          error: function(xhr) {
                              console.log(xhr.responseText);
                          }
                      });
                  });
              });

              $(document).on('click', '.btn-update', function(e) {

                  let positionId = $('#position_id').val();
                  var var_url = '{{ route('positions.update', ':positionId') }}'.replace(':positionId', positionId);
                  var var_type = 'PUT';
                  $.ajax({
                      url: var_url,
                      type: var_type,
                      data: {
                          name: $('#name_edit').val(),

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

                              $('#tablePositions').DataTable().ajax.reload(null, false);

                              $('#modalEditPosisi').modal('hide');

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
          </script> --}}
      @endpush
  @endsection
