  @extends('layout.app')

  @section('content')
      <div class="main-content">
          <section class="section">
              <div class="section-header">
                  <h1>Users</h1>
                  <div class="section-header-breadcrumb">
                      <div class="breadcrumb-item active"><a href="/">Dasboard</a></div>
                      <div class="breadcrumb-item">Users</div>
                  </div>
              </div>

              <div class="section-body">
                  <h2 class="section-title">Users</h2>


                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="card-header">
                                  <a class="btn btn-sm btn-danger float-left text-white" href="{{ route('user.trashed') }}"
                                      id="showDeletedButtonIntern"><i id="showDeletedIcon"
                                          class="fas fa-trash mr-2 color-white"></i> Lihat Data Terhapus</a>
                                  <div class="ml-auto">
                                      <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary tombol-create"
                                          data-placement="top" id="btn-create" data-toggle="tooltip"
                                          title="Tambah Data User">
                                          <i class="fas fa-plus mr-2"></i> Data User
                                      </a>
                                  </div>

                              </div>
                              <div class="card-body">
                                  <div class="table-responsive">
                                      <table class="table table-striped" id="tableUsers">
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
                      // responsive: true,
                      ajax: {
                          url: "{{ route('users.index') }}"
                      },
                      columns: [{
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
                              name: 'role.name'
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
