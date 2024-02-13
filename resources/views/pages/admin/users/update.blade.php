@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('roles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit User {{ $users->username }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
                    <div class="breadcrumb-item">Edit User {{ $users->username }}</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Edit User</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('users.update', $users->id) }}"
                                    enctype="multipart/form-data" id="formEditUsers">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Lengkap <span class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="full_name" id="full_name"
                                                placeholder="eg. John Doe" value="{{ $users->full_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Panggilan <span class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="eg. John" value="{{ $users->username }}">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" placeholder="">{{ $users->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Mulai
                                            <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </div>
                                                </div>
                                                <input type="text" class="form-control datepicker" name="entry_date"
                                                    id="entry_date" value="{{ $users->entry_date }}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Telephone <span
                                                class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </div>
                                                </div>
                                                <input type="number" class="form-control phone-number" name="telp"
                                                    id="telp" placeholder="081xxxxxxx" value="{{ $users->telp }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                </div>
                                                <input type="email" class="form-control email" name="email"
                                                    id="email" placeholder="eg. john@gmail.com"
                                                    value="{{ $users->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4" style="display: none">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-lock"></i>
                                                    </div>
                                                </div>
                                                <input type="password" name="password" id="password" value="password"
                                                    class="form-control pwstrength">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Posisi <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="position_id" id="position_id">
                                                <option value="" selected>Pilih Posisi</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        data-level="{{ $position->level }}"
                                                        {{ $users->position_id == $position->id ? 'selected' : '' }}
                                                        data-positions="{{ $position->name }}">
                                                        {{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4 d-none" id="divisionField">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Divisi <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="division_id" id="division_id">
                                                <option value="" selected>Pilih Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ $users->division_id == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4 atasan-row d-none" id="atasanField">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Atasan <span
                                                class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="manager_id" id="atasanSelect">
                                                <option value="" selected>Pilih Atasan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="role_id">
                                                <option value="" selected @readonly(true)>Pilih Role</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $users->role_id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Update Users</button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </section>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var divisionField = $('#divisionField');
            var managerField = $('#managerField');
            var cooField = $('#cooField');
            var divisionSelect = document.getElementById('division_id');
            var managerSelect = document.getElementById('managerSelect');
            var cooSelect = document.getElementById('cooSelect');
            var defaultOption = '<option value="" selected>Pilih Manager</option>';
            var defaultDivision = '<option value="" selected>Pilih Divisi</option>';
            var defaultCOO = '<option value="" selected>Pilih COO</option>';

            var userLevel = "{{ $users->position->level }}";
            var currentUserPositionId = "{{ $users->position_id }}";
            var currentUserDivisionId = "{{ $users->division_id }}";

            $('#managerSelect').selectric();
            $('#cooSelect').selectric();


            // Fungsi untuk menampilkan atau menyembunyikan field berdasarkan kondisi
            function showHideFields() {
                if (userLevel === '1') {
                    divisionField.hide();
                    managerField.hide();
                } else if (userLevel === '4') {
                    cooField.show();
                    divisionField.show();
                    managerField.show(); // ManagerField disembunyikan saat tampilan awal
                } else {
                    divisionField.show();
                    managerField.show();
                }
            }

            showHideFields();

            // Event listener untuk perubahan pada select posisi
            $('#position_id').change(function() {
                var selectedLevel = $(this).find(':selected').data('level');
                console.log('Level Posisi Selected : ' + selectedLevel);

                if (selectedLevel === 1) {
                    $('#divisionField').hide();
                    $('select[id="division_id"]').val('');
                    $('#managerField').hide();
                    $('select[id="managerSelect"]').val('');
                    $('#cooField').hide();
                    $('select[id="cooSelect"]').val('');

                } else {
                    divisionField.show();
                    managerField.show();
                    managerSelect.innerHTML = defaultOption;
                    cooSelect.hide();
                }


            });



            $('#division_id').change(function() {
                var selectedLevel = $('#position_id').find(':selected').data('level');
                var selectedDivisionId = $(this).val();

                if (selectedLevel !== 1 && selectedDivisionId) {
                    $('#managerField').show();
                    managerSelect.innerHTML = defaultOption;

                    fetchManagers(selectedDivisionId);
                    fetchTopManagers();
                } else {
                    $('#managerField').hide();
                }
            });

            // Fetch managers sesuai divisi
            function fetchManagers(divisionId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.manager') }}',
                    data: {
                        division_id: divisionId
                    },
                    success: function(data) {
                        appendOptions(data, divisionId);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching managers:', errorThrown);
                    }
                });
            }

            // Fetch top managers
            function fetchTopManagers() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.topManagers') }}',
                    success: function(data) {
                        appendOptions(data, 'all');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching top managers:', errorThrown);
                    }
                });
            }

            // Fungsi untuk menambahkan opsi ke select manager
            function appendOptions(data, divisionId) {
                data.forEach(function(manager) {
                    var positionName = (manager.position && manager.position.name) ? manager.position.name :
                        '';
                    var optionText = manager.full_name + (positionName ? ' (' + positionName + ')' : '');

                    var option = document.createElement('option');
                    option.value = manager.id;
                    option.setAttribute('data-division', divisionId); // Menandai opsi dengan division_id
                    option.textContent = optionText;

                    managerSelect.appendChild(option);
                });

                $(managerSelect).selectric('refresh');
            }

            function fetchCOOs(divisionId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.coo') }}',
                    data: {
                        division_id: divisionId
                    },
                    success: function(data) {
                        appendCOOOptions(data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching COOs:', errorThrown);
                    }
                });
            }

            function appendCOOOptions(data) {
                var cooSelect = document.getElementById('cooSelect');
                cooSelect.innerHTML = defaultOptionCOO;

                data.forEach(function(coo) {
                    var optionText = coo.full_name;
                    var option = document.createElement('option');
                    option.value = coo.id;
                    option.textContent = optionText;

                    cooSelect.appendChild(option);
                });

                $(cooSelect).selectric('refresh');
            }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            var divisionField = $('#divisionField');
            var atasanField = $('#atasanField');
            var positionSelect = $('#position_id');
            var divisionSelect = $('#division_id');
            var atasanSelect = $('#atasanSelect');

            var userLevel = "{{ $users->position->level }}";
            var selectedAtasan = "{{ $users->manager_id }}";
            console.log(selectedAtasan);

            function showHideFields() {
                if (userLevel === '1') {
                    divisionField.addClass('d-none');
                    atasanField.addClass('d-none');
                } else {
                    divisionField.removeClass('d-none');
                    atasanField.removeClass('d-none');
                }
            }

            showHideFields();

            updateAtasanOptions();

            positionSelect.change(function() {
                var selectedPositionId = $(this).val();
                console.log('Id Posisi yang diplih : ' + selectedPositionId);

                if (selectedPositionId) {
                    // Fetch position level based on selected position_id
                    fetchPositionLevel(selectedPositionId);
                } else {
                    divisionField.addClass('d-none');
                    atasanField.addClass('d-none');
                }
            });

            divisionSelect.change(function() {
                updateAtasanOptions();
            });

            // Fungsi untuk mengambil dan menampilkan opsi atasan
            function updateAtasanOptions() {
                var selectedPositionId = positionSelect.val();
                var selectedDivisionId = divisionSelect.val();

                if (selectedPositionId && selectedPositionId > 1 && selectedDivisionId) {
                    atasanField.removeClass('d-none');
                    fetchManagers(selectedPositionId, selectedDivisionId);
                } else {
                    atasanField.addClass('d-none');
                }
            }

            // Fungsi untuk mengambil data posisi
            function fetchPositionLevel(positionId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.getPositionLevel') }}',
                    data: {
                        position_id: positionId
                    },
                    success: function(data) {
                        // Show division field if position level is 2, 3, or 4
                        if (data > 1) {
                            divisionField.removeClass('d-none');
                        } else {
                            divisionField.addClass('d-none');
                        }

                        // Trigger change event on divisionSelect to update managers
                        divisionSelect.trigger('change');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching position level:', errorThrown);
                    }
                });
            }

            // Fungsi untuk mengambil data atasan
            function fetchManagers(positionId, divisionId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.getManagers') }}',
                    data: {
                        position_id: positionId,
                        division_id: divisionId
                    },
                    success: function(data) {
                        populateAtasanOptions(data);
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching managers:', errorThrown);
                    }
                });
            }

            // Fungsi untuk menampilkan opsi atasan
            function populateAtasanOptions(data) {
                atasanSelect.empty().append('<option value="" selected>Pilih Atasan</option>');

                if (data && data.length > 0) {
                    $.each(data, function(index, manager) {
                        var positionName = manager.position ? ' (' + manager.position.name + ')' : '';
                        var optionText = manager.full_name + positionName;

                        // Memeriksa apakah manager.id sama dengan selectedManagerId
                        var isSelected = (manager.id == selectedAtasan) ? 'selected' : '';

                        atasanSelect.append('<option value="' + manager.id + '" ' + isSelected + '>' +
                            optionText +
                            '</option>');
                    });
                }

                atasanSelect.selectric('refresh');
            }
        });
    </script>



    <script>
        $(document).ready(function() {
            $("#formEditUsers").on("submit", function(e) {
                e.preventDefault();

                var usersId = "{{ $users->id }}";

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
                    url: '{{ route('users.update', ['user' => ':usersId']) }}'.replace(':usersId',
                        usersId),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href = '{{ route('users.index') }}';
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
                            // Menampilkan pesan kesalahan dari respons JSON
                            var errorMessage = xhr.responseJSON
                                .message; // Mendapatkan pesan kesalahan dari controller
                            Swal.fire('Gagal', errorMessage,
                                'error'); // Menampilkan pesan kesalahan di SweetAlert
                        }
                    },

                });
            });
        });
    </script>
@endsection
