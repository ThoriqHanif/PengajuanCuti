@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Tambah User Baru</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
                    <div class="breadcrumb-item">Tambah User</div>
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
                                    <div class="form-group row mb-4 d-none" id="divisionField">
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

                                    <div class="form-group row mb-4 atasan-row d-none" id="atasanField">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Atasan <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="manager_id" id="atasanSelect">
                                                <option value="" selected>Pilih Atasan</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4 d-none">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">COO ID</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" id="coo_id" name="coo_id"
                                                readonly>
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
                                            <button type="submit" class="btn btn-primary">Buat Users</button>
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

    <script>
        $(document).ready(function() {
            var divisionField = $('#divisionField');
            var atasanField = $('#atasanField');
            var positionSelect = $('#position_id');
            var divisionSelect = $('#division_id');
            var atasanSelect = $('#atasanSelect');
            var cooIdInput = $('#coo_id');

            positionSelect.change(function() {
                var selectedPositionId = $(this).val();

                if (selectedPositionId) {
                    fetchPositionLevel(selectedPositionId);
                } else {
                    divisionField.addClass('d-none');
                    atasanField.addClass('d-none');
                }
            });

            divisionSelect.change(function() {
                var selectedPositionId = positionSelect.val();
                var selectedDivisionId = $(this).val();

                if (selectedPositionId && selectedPositionId > 1 && selectedDivisionId) {
                    atasanField.removeClass('d-none');
                    fetchManagers(selectedPositionId, selectedDivisionId);
                } else {
                    atasanField.addClass('d-none');
                }
            });

            atasanSelect.change(function() {
                var selectedManagerId = $(this).val();

                if (selectedManagerId) {
                    fetchCooId(selectedManagerId);
                }
            });

            function fetchPositionLevel(positionId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.getPositionLevel') }}',
                    data: {
                        position_id: positionId
                    },
                    success: function(data) {
                        if (data > 1) {
                            divisionField.removeClass('d-none');
                        } else {
                            divisionField.addClass('d-none');
                        }

                        divisionSelect.trigger('change');
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching position level:', errorThrown);
                    }
                });
            }

            function fetchManagers(positionId, divisionId) {
                var requestData = {
                    position_id: positionId
                };

                // Cek jika divisionId tidak null
                if (divisionId) {
                    requestData['division_id'] = divisionId;
                }

                // Cek level posisi yang dipilih
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.getManagers') }}',
                    data: requestData,
                    success: function(data) {
                        // Jika level posisi adalah 2, panggil endpoint untuk mendapatkan atasan level 1
                        if (positionId === '2') {
                            $.ajax({
                                type: 'GET',
                                url: '{{ route('user.getTopManagers') }}',
                                success: function(topManagers) {
                                    populateAtasanOptions(topManagers);
                                },
                                error: function(xhr, textStatus, errorThrown) {
                                    console.error('Error fetching top managers:',
                                        errorThrown);
                                }
                            });
                        } else {
                            populateAtasanOptions(data);
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching managers:', errorThrown);
                    }
                });
            }


            function populateAtasanOptions(data) {
                atasanSelect.empty().append('<option value="" selected>Pilih Atasan</option>');

                if (data && data.length > 0) {
                    $.each(data, function(index, manager) {
                        var positionName = manager.position ? ' (' + manager.position.name + ')' : '';
                        var optionText = manager.full_name + positionName;

                        atasanSelect.append('<option value="' + manager.id + '">' + optionText +
                            '</option>');
                    });
                }

                atasanSelect.selectric('refresh');
            }

            function fetchCooId(managerId) {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('user.getCooId') }}',
                    data: {
                        manager_id: managerId
                    },
                    success: function(data) {
                        if (data && data.coo_id) {
                            cooIdInput.val(data.coo_id);
                        } else {
                            console.error('COO ID not found for selected manager.');
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching COO ID:', errorThrown);
                    }
                });
            }
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


    {{-- FIX JIKA TANPA COO --}}
    {{-- <script>
        $(document).ready(function() {
            var divisionField = $('#divisionField');
            var atasanField = $('#atasanField');
            var positionSelect = $('#position_id');
            var divisionSelect = $('#division_id');
            var atasanSelect = $('#atasanSelect');

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
                var selectedPositionId = positionSelect.val();
                var selectedDivisionId = $(this).val();

                if (selectedPositionId && selectedPositionId > 1 && selectedDivisionId) {
                    atasanField.removeClass('d-none');
                    fetchManagers(selectedPositionId, selectedDivisionId);
                } else {
                    atasanField.addClass('d-none');
                }
            });

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

            function populateAtasanOptions(data) {
                atasanSelect.empty().append('<option value="" selected>Pilih Atasan</option>');

                if (data && data.length > 0) {
                    $.each(data, function(index, manager) {
                        var positionName = manager.position ? ' (' + manager.position.name + ')' : '';
                        var optionText = manager.full_name + positionName;

                        atasanSelect.append('<option value="' + manager.id + '">' + optionText +
                            '</option>');
                    });
                }

                atasanSelect.selectric('refresh');
            }
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#position_id').change(function() {
                var selectedLevel = $(this).find(':selected').data('level');
                console.log(selectedLevel);

                if (selectedLevel === 1) {
                    $('#divisionField').hide();
                    $('#atasanField').hide();
                    $('select[id="division_id"]').val('');
                    $('select[id="manager_id"]').val('');
                } else {
                    $('#divisionField').show();
                    $('#atasanField').show();
                }
            });
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var managerSelect = document.getElementById('managerSelect');
            var cooSelect = document.getElementById('cooSelect');
            var defaultOption = '<option value="" selected>Pilih Manager</option>';
            var defaultOptionCOO = '<option value="" selected>Pilih COO</option>';

            $('#managerSelect').selectric();
            $('#cooSelect').selectric();

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
                    var positionName = (coo.position && coo.position.name) ? coo.position.name : '';
                    console.log(positionName);
                    var optionText = coo.full_name + (positionName ? ' (' + positionName + ')' : '');
                    var option = document.createElement('option');
                    option.value = coo.id;
                    option.textContent = optionText;

                    cooSelect.appendChild(option);
                });

                $(cooSelect).selectric('refresh');
            }

        
            $('#division_id').change(function() {
                var selectedLevel = $('#position_id').find(':selected').data('level');
                var selectedDivisionId = $(this).val();

                if (selectedLevel !== 1 && selectedDivisionId) {
                    $('#managerField').show();
                    managerSelect.innerHTML = defaultOption;

                    fetchManagers(selectedDivisionId);
                    fetchTopManagers();

                    if (selectedLevel === 4) {
                        $('#cooField').show();
                        cooSelect.innerHTML = defaultOptionCOO;

                        fetchCOOs(selectedDivisionId);
                    } else {
                        $('#cooField').hide();
                        // $('select[id="coo_id"]').val('');
                    }
                } else {
                    $('#managerField').hide();
                    $('#cooField').hide();
                }
            });
        });
    </script> --}}
@endsection
