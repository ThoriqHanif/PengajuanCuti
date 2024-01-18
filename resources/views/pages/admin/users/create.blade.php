@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Create New User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
                    <div class="breadcrumb-item">Create New User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Tambah User</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data"
                                    id="formUsers">
                                    @csrf
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Lengkap <span class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="full_name" id="full_name"
                                                placeholder="eg. John Doe">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Panggilan <span class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="eg. John">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" placeholder=""></textarea>
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
                                                    id="entry_date">
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
                                                    id="telp" placeholder="081xxxxxxx">
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
                                                    id="email" placeholder="eg. john@gmail.com">
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
                                                        data-positions="{{ $position->name }}">
                                                        {{ $position->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4" id="divisionField" style="display: none;">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Divisi <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="division_id" id="division_id">
                                                <option value="" selected>Pilih Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}">
                                                        {{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4 manager-row" id="managerField"
                                        style="display: none;">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Manager <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="manager_id" id="managerSelect">
                                                <option value="" selected>Pilih Manager</option>

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
                                                    <option value="{{ $role->id }}">
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Create Users</button>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-header">
                    <h4>Hak Akses</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="col-form-label">Admin</label>
                                <div class="custom-switches-stacked mt-4">
                                    <label class="custom-switch">
                                        <input type="checkbox" id="toggleAdmin" class="custom-switch-input">
                                        <span class="custom-switch-indicator"></span>
                                        <span class="custom-switch-description">Pilih Semua</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @php
                            $groupedPermissions = $permissions->groupBy('menu_name');
                        @endphp

                        @foreach ($groupedPermissions as $menuName => $menuPermissions)
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="col-form-label">Menu {{ $menuName }}</label>
                                    
                                    <div class="custom-switches-stacked mt-4">
                                        @foreach ($menuPermissions as $permission)
                                            <label class="custom-switch">
                                                <input type="checkbox" name="permissions[]"
                                                    value="{{ $permission->id }}" class="custom-switch-input">
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> --}}
            </form>

        </section>
    </div>

    {{-- <script>
        $(document).ready(function() {
            $('#divisionSelect').on('change', function() {

                var selectedDivision = $(this).val();
                console.log(selectedDivision);
    
                $.ajax({
                    url: '{{ route('user.manager') }}',
                    type: 'GET',
                    data: { division_id: selectedDivisionId },
                    success: function(response) {
                        console.log(response);

                        $('#managerSelect').empty();
    
                        $.each(response.managers, function(index, manager) {
                            $('#managerSelect').append('<option value="' + manager.id + '">' + manager.full_name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script> --}}


    {{-- <script>
        $(document).ready(function() {
            $('#position_id').change(function() {
                var selectedLevel = $(this).find(':selected').data('level');

                console.log(selectedLevel);
                if (selectedLevel === 1) {
                    $('#managerField').hide();
                    $('select[id="managerSelect"]').val('');
                } else {
                    $('#managerField').show();
                }
            });

            $('#division_id').change(function() {
                var selectedDivisionId = $(this).val();
                console.log(selectedDivisionId);

                if (selectedDivisionId) {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route('user.manager') }}',
                        data: {
                            division_id: selectedDivisionId
                        },
                        success: function(data) {
                            console.log(data);
                            var managerSelect = $('select[id="managerSelect"]');
                            console.log(managerSelect);

                            managerSelect.empty().append('<option value="" selected>Pilih Manager</option>');

                            // managerSelect.find('option:not(:first)').remove();

                            $.each(data, function(index, manager) {
                                var positionName = (manager.position && manager.position.name) ? manager.position.name : '';

                                console.log(manager.id, manager.full_name, positionName);

                                managerSelect.append('<option value="' + manager.id + '">' + manager.full_name + ' (' + positionName + ')</option>');
                                
                            });
                            console.log(managerSelect.html());
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Error fetching managers:', errorThrown);
                        }
                    });
                } else {
                    var managerSelect = $('select[name="manager_id"]');
                    
                    managerSelect.empty().append(
                        '<option value="" selected>Pilih Divisi Terlebih Dahulu</option>');
                }
            });
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#position_id').change(function() {
                var selectedLevel = $(this).find(':selected').data('level');
    
                if (selectedLevel === 1) {
                    // Jika level adalah 1, sembunyikan divisi
                    $('#divisionField').hide();
                    $('select[id="division_id"]').val('');
                } else {
                    // Jika level bukan 1, tampilkan divisi
                    $('#divisionField').show();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var managerSelect = document.getElementById('managerSelect');
            var defaultOption = '<option value="" selected>Pilih Manager</option>';
            

            $('#managerSelect').selectric();

            $('#position_id, #division_id').change(function() {
                var selectedLevel = $('#position_id').find(':selected').data('level'); 
                // SelectedLevel = Level dari position yang dipilih di select
                console.log(selectedLevel);
                
                var selectedDivisionId = $('#division_id').val();
                // selectedDivisionId = divisi_id yang dipilih dari select Divisi
                console.log(selectedDivisionId);

                

                if (selectedLevel === 1 || !selectedDivisionId) {
                    $('#managerField').hide();
                    managerSelect.innerHTML = defaultOption;
                    // Jika level position yg dipilih 1 -> manager hide & set defaultOption

                } else {
                    $('#managerField').show();
                    // Jika bukan level position yg dipilih 1 -> manager muncul

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('user.manager') }}',
                        data: {
                            division_id: selectedDivisionId,
                            position_level : positionLevel,
                        },
                        success: function(data) {
                            managerSelect.innerHTML = defaultOption;

                            data.forEach(function(manager) {
                                var positionName = (manager.position && manager.position.name) ? manager.position.name : '';
                                var optionText = manager.full_name + (positionName ? ' (' + positionName + ')' : '');

                                var option = document.createElement('option');
                                option.value = manager.id;
                                option.textContent = optionText;

                                managerSelect.appendChild(option);
                            });

                            $(managerSelect).selectric('refresh');

                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.error('Error fetching managers:', errorThrown);
                        }
                    });
                }
            });
        });
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var managerSelect = document.getElementById('managerSelect');
            var defaultOption = '<option value="" selected>Pilih Manager</option>';

            $('#managerSelect').selectric();

            function fetchManagers(divisionId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.manager') }}',
                    data: {
                        division_id: divisionId
                    },
                    success: function(data) {
                        managerSelect.innerHTML = defaultOption;

                        data.forEach(function(manager) {
                            var positionName = (manager.position && manager.position.name) ?
                                manager.position.name : '';
                            var optionText = manager.full_name + (positionName ? ' (' +
                                positionName + ')' : '');

                            var option = document.createElement('option');
                            option.value = manager.id;
                            option.setAttribute('data-division',
                            divisionId); // Menandai opsi dengan division_id
                            option.textContent = optionText;

                            managerSelect.appendChild(option);
                        });

                        $(managerSelect).selectric('refresh');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching managers:', errorThrown);
                    }
                });
            }

            function fetchTopManagers() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.topManagers') }}',
                    success: function(data) {
                        managerSelect.innerHTML = defaultOption;

                        data.forEach(function(manager) {
                            var positionName = (manager.position && manager.position.name) ?
                                manager.position.name : '';
                            var optionText = manager.full_name + (positionName ? ' (' +
                                positionName + ')' : '');

                            var option = document.createElement('option');
                            option.value = manager.id;
                            option.setAttribute('data-division',
                            'all'); // Menandai opsi untuk top managers
                            option.textContent = optionText;

                            managerSelect.appendChild(option);
                        });

                        $(managerSelect).selectric('refresh');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching top managers:', errorThrown);
                    }
                });
            }

            $('#position_id, #division_id').change(function() {
                var selectedLevel = $('#position_id').find(':selected').data('level');
                var selectedDivisionId = $('#division_id').val();

                if (selectedLevel === 1 || !selectedDivisionId) {
                    $('#managerField').hide();
                    fetchTopManagers();
                } else {
                    $('#managerField').show();
                    fetchTopManagers().;
                    fetchManagers(selectedDivisionId);

                }
            });
        });
    </script> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#position_id').change(function() {
                var selectedLevel = $(this).find(':selected').data('level');

                if (selectedLevel === 1) {
                    $('#divisionField').hide();
                    $('select[id="division_id"]').val('');
                } else {
                    $('#divisionField').show();
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var managerSelect = document.getElementById('managerSelect');
            var defaultOption = '<option value="" selected>Pilih Manager</option>';

            $('#managerSelect').selectric();

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
        });
    </script>



    <script>
        $(document).ready(function() {
            $("#formUsers").on("submit", function(e) {
                e.preventDefault();

                // Tampilkan pesan "loading" saat akan mengirim permintaan AJAX
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
                    url: '{{ route('users.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tutup pesan "loading" saat berhasil
                        Swal.close();

                        if (response.success) {
                            // Redirect ke halaman index dengan pesan "success"
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
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
@endsection
