@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('leaves.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Tambah Pengajuan Cuti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Pengajuan</a></div>
                    <div class="breadcrumb-item">Tambah Pengajuan Cuti</div>
                </div>
            </div>
            <div class="section-body">
                <form method="POST" action="{{ route('leaves.store') }}" enctype="multipart/form-data" id="formLeaves">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Informasi</h4>
                                </div>
                                <div class="card-body">
                                    <input type="text" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                                        hidden>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Lengkap <span class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="full_name" id="full_name"
                                                placeholder="eg. John Doe" value="{{ auth()->user()->full_name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Posisi <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="position_id" id="position_id"
                                                disabled>
                                                <option value="" selected>Pilih Posisi</option>
                                                @foreach ($positions as $position)
                                                    <option value="{{ $position->id }}"
                                                        {{ auth()->user()->position_id == $position->id ? 'selected' : '' }}>
                                                        {{ $position->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4" id="divisionField">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Divisi <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="division_id" id="division_id"
                                                disabled>
                                                <option value="" selected>Pilih Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}"
                                                        {{ auth()->user()->division_id == $division->id ? 'selected' : '' }}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4" id="managerField">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Manager <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="manager_id" id="manager_id"
                                                disabled>
                                                <option value="" selected>Pilih Manager</option>
                                                @foreach ($managers as $manager)
                                                    <option value="{{ $manager->id }}"
                                                        {{ auth()->user()->manager_id == $manager->id ? 'selected' : '' }}>
                                                        {{ $manager->full_name }} ({{ $manager->position->name }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="role_id" disabled>
                                                <option value="" selected @readonly(true)>Pilih Role</option>
                                                <option value="{{ auth()->user()->role_id }}" selected>
                                                    {{ auth()->user()->role->name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </div> --}}
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Tambah Cuti</h4>
                                    </div>
                                    <div class="card-body">

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Cuti
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-sm-12 col-md-7">
                                                <select class="form-control selectric" name="type_id" id="type_id">
                                                    <option value="" selected>Pilih Jenis</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{ $type->id }}"
                                                            data-types="{{ $type->name }}">
                                                            {{ $type->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Periode
                                                Cuti <span class="text-danger"> *</span></label>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <input type="date" class="form-control " name="start_date"
                                                        id="start_date">
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <p>-</p>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                    <input type="date" class="form-control" name="end_date"
                                                        id="end_date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah
                                                Cuti
                                                <span class="text-danger"> *</span></label>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" name="duration"
                                                    id="duration" readonly>
                                            </div>
                                            <div class="col-sm-2">
                                                <select name="" id="" class="form-control selectric"
                                                    disabled>
                                                    <option value="" selected>Hari</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alasan
                                                <span class="text-danger"> *</span>
                                            </label>
                                            <div class="col-sm-12 col-md-7">
                                                <textarea type="text" class="form-control" name="reason" id="reason" placeholder="Alasan Cuti"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                            <div class="col-sm-12 col-md-7">
                                                <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                </form>

            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Rekapitulasi Cuti</h4>
                </div>
                <div class="card-body">
                    @foreach ($types as $type)
                        <div class="col-md-12 mb-5">
                            <div class="section-title mb-2" id="name_type">{{ $type->name }}</div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <thead>
                                        <tr>
                                            <th data-width="80">No</th>
                                            <th>Tahun</th>
                                            <th class="text-center">Jumlah Cuti</th>
                                            <th class="text-center">Terpakai</th>
                                            <th class="text-right">Sisa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ \Carbon\Carbon::parse($type->created_at)->format('Y') }}</td>
                                            <td class="text-center">{{ $type->duration }} {{ $type->time }}</td>
                                            <td class="text-center">{{ $cutiTerpakaiPerType[$type->id] ?? 0 }}
                                                {{ $type->time }}</td>
                                            <td class="text-right">{{ $sisaPerType[$type->id] ?? $type->duration }}
                                                {{ $type->time }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>



        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#type_id').change(function() {
                var selectedTypeId = $(this).val();
                console.log(selectedTypeId);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Fungsi untuk menghitung jumlah hari antara dua tanggal
            function calculateDuration() {
                var startDate = moment($('#start_date').val(), 'YYYY-MM-DD');
                var endDate = moment($('#end_date').val(), 'YYYY-MM-DD');

                if (startDate.isValid() && endDate.isValid() && endDate.isSameOrAfter(startDate)) {
                    var duration = endDate.diff(startDate, 'days') + 1; // Tambah 1 hari karena inklusif
                    $('#duration').val(duration);
                } else {
                    $('#duration').val('');
                }
            }


            $('#start_date, #end_date').change(function() {
                calculateDuration();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Ambil level posisi pengguna
            var userPositionLevel = {{ auth()->user()->position->level ?? 0 }};

            // Ambil division_id dan manager_id dari pengguna yang login
            var userDivisionId = {{ auth()->user()->division_id ?? 0 }};
            var userManagerId = {{ auth()->user()->manager_id ?? 0 }};

            // Sembunyikan atau tampilkan divisi dan manajer berdasarkan level posisi
            if (userPositionLevel === 1) {
                $('#divisionField').hide();
                $('#managerField').hide();
            } else {
                $('#divisionField').show();
                $('#managerField').show();

                // Set nilai awal division_id dan manager_id untuk pengguna dengan level posisi selain 1
                $('#division_id').val(userDivisionId);
                $('#manager_id').val(userManagerId);
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dapatkan elemen input tanggal mulai dan tanggal selesai
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            // Parse tanggal hari ini
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Atur jam ke tengah malam

            // Tambahkan event listener pada perubahan input tanggal selesai
            endDateInput.addEventListener('change', function() {
                // Parse tanggal mulai dan tanggal selesai ke dalam objek Date
                var startDate = new Date(startDateInput.value);
                var endDate = new Date(endDateInput.value);

                // Bandingkan tanggal dan lakukan validasi
                if (startDate > endDate) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai harus setelah tanggal mulai',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                } else if (endDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                }
            });

            // Tambahkan event listener pada perubahan input tanggal mulai
            startDateInput.addEventListener('change', function() {
                // Parse tanggal mulai ke dalam objek Date
                var startDate = new Date(startDateInput.value);

                // Bandingkan tanggal mulai dengan tanggal hari ini
                if (startDate < today) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal mulai tidak boleh kurang dari tanggal hari Ini',
                        confirmButtonText: 'Ok'
                    });

                    startDateInput.value = '';
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#formLeaves").on("submit", function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Mohon Tunggu!',
                    html: 'Sedang memproses data...',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('leaves.store') }}',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.close();
                        console.log(response);

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan.',
                            }).then(function() {
                                window.location.href = '{{ route('leaves.index') }}';
                            });
                        } else {
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

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dapatkan elemen input tanggal mulai dan tanggal selesai
            var startDateInput = document.getElementById('start_date');
            var endDateInput = document.getElementById('end_date');

            // Inisialisasi datepicker menggunakan library atau plugin yang Anda gunakan
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            // Tambahkan event listener pada perubahan input tanggal selesai
            endDateInput.addEventListener('change', function () {
                // Parse tanggal mulai dan tanggal selesai menggunakan moment
                var startDate = moment(startDateInput.value, 'YYYY-MM-DD');
                var endDate = moment(endDateInput.value, 'YYYY-MM-DD');
                var today = moment().startOf('day'); // Tanggal hari ini

                // Bandingkan tanggal dan lakukan validasi
                if (startDate.isAfter(endDate)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai harus setelah tanggal mulai',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                } else if (endDate.isBefore(today)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal selesai tidak boleh kurang dari tanggal hari ini',
                        confirmButtonText: 'Ok'
                    });

                    endDateInput.value = '';
                }
            });

            // Tambahkan event listener pada perubahan input tanggal mulai
            startDateInput.addEventListener('change', function () {
                // Parse tanggal mulai menggunakan moment
                var startDate = moment(startDateInput.value, 'YYYY-MM-DD');
                var today = moment().startOf('day'); // Tanggal hari ini

                // Bandingkan tanggal mulai dengan tanggal hari ini
                if (startDate.isBefore(today)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oopss...',
                        text: 'Tanggal mulai tidak boleh kurang dari tanggal hari ini',
                        confirmButtonText: 'Ok'
                    });

                    startDateInput.value = '';
                }
            });
        });
    </script> --}}
@endsection
