  @extends('layout.app')

  @section('content')
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Users</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dasboard</a></div>
                      <div class="breadcrumb-item">Users</div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Users</h2>


                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              @canany('trashed users', 'create users')
                                  <div class="card-header">
                                      @can('trashed users')
                                          <a class="btn btn-sm btn-danger float-left text-white" href="{{ route('user.trashed') }}"
                                              id="showDeletedButtonIntern"><i id="showDeletedIcon"
                                                  class="fas fa-trash mr-2 color-white"></i> Data Terhapus</a>
                                      @endcan
                                      @can('create users')
                                          <div class="ml-auto">
                                              <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary tombol-create"
                                                  data-placement="top" id="btn-create" data-toggle="tooltip"
                                                  title="Tambah Data User">
                                                  <i class="fas fa-plus mr-2"></i> Data User
                                              </a>
                                          </div>
                                      @endcan


                                  </div>
                              @endcanany

                              <div class="card-body">
                                  {{-- <div class="table-responsive"> --}}
                                  <table class="table table-striped table-sm" id="tableUsers">
                                      <thead>
                                          <tr>
                                              <th class="table-fit">No</th>
                                              <th>Nama Lengkap</th>
                                              <th>Email</th>
                                              <th>Divisi</th>
                                              <th>Posisi</th>
                                              <th>Manager</th>
                                              <th>Role</th>
                                              <th>Tanggal Masuk</th>
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


      @push('script-users')
          <script>
              $(document).ready(function() {

                  var tableUsers = $('#tableUsers').DataTable({
                      processing: true,
                      serverSide: true,
                      responsive: true,
                      ajax: {
                          url: "{{ route('users.index') }}"
                      },
                      columns: [{
                              data: 'DT_RowIndex',
                              name: 'DT_RowIndex',
                              orderable: false,
                              searchable: false,
                              class: 'table-fit'

                          },
                          {
                              data: 'full_name',
                              name: 'full_name',
                              class: 'table-fit'
                          },
                          {
                              data: 'email',
                              name: 'email'
                          },

                          {
                              data: 'division.name',
                              name: 'division.name',
                              render: function(data, type, full, meta) {
                                  return data || '<p>-</p>';
                              },
                              //   className: 'text-center'
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
                              //   className: 'text-center'
                          },
                          {
                              data: 'role.name',
                              name: 'role.name',
                              className: 'text-capitalize'
                          },
                          {
                              data: 'entry_date',
                              name: 'entry_date',
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
                              data: 'action',
                              name: 'action',
                              class: 'table-fit'
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
