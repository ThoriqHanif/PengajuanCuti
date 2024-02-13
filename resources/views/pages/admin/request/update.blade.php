@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('request-leave.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Review Permohonan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('request-leave.index') }}">Permohonan</a></div>
                    <div class="breadcrumb-item">Review Permohonan Cuti</div>
                </div>
            </div>

            <div class="section-body">
                <form method="POST" action="{{ route('request-leave.update', ['request_leave' => $leaves->id]) }}"
                    enctype="multipart/form-data" id="formEditRequests">
                    @csrf

                    @method('PUT')
                    <div class="invoice">
                        <div class="invoice-print">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="invoice-title">
                                        <h2>Cutikita</h2>
                                        <div class="invoice-number">
                                            <span class="text-primary">#{{ $leaves->code }}</span>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-md-9 col-lg-9 mt-3">
                                    {{-- <hr> --}}
                                    <div class="row py-2 px-3" style="background-color: #d8daf242; border-radius: 10px">
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Nama
                                                Lengkap</label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->user->full_name }}
                                            </p>

                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Posisi</label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->user->position->name }}
                                            </p>

                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Divisi</label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->user->division->name }}
                                            </p>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Email
                                            </label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->user->email }}
                                            </p>

                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Telephone
                                            </label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->user->telp }}
                                            </p>

                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Atasan</label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->user->manager->full_name }}
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-lg-3 mt-3">
                                    <div class="py-5"
                                        style="background-color: #d8daf242; border-radius: 10px; width: 200px; text-align: center">
                                        {{-- <div class="=" style=""> --}}
                                        <div class="col-md-12">

                                            @if ($leaves->user->photo)
                                                <img alt="image" src="{{ asset('files/photo/' . $leaves->user->photo) }}"
                                                    class="" width="100" style="border-radius: 10px">
                                            @else
                                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                    class="" width="100" style="border-radius: 10px">
                                            @endif

                                            {{-- <div class="mt-4">
                                                <div class="">
                                                    @php
                                                    $statusManagerText = '';
                                                    $textColor = '';

                                                    switch ($leaves->status_manager) {
                                                        case 0:
                                                            $statusManagerText = 'Pending';
                                                            $textColor = 'orange';
                                                            break;
                                                        case 1:
                                                            $statusManagerText = 'Sedang Direview';
                                                            $textColor = 'blue';
                                                            break;
                                                        case 2:
                                                            $statusManagerText = 'Disetujui';
                                                            $textColor = 'green';
                                                            break;
                                                        case 3:
                                                            $statusManagerText = 'Ditolak';
                                                            $textColor = 'red';
                                                            break;
                                                        default:
                                                            $statusManagerText = 'Undefined';
                                                            $textColor = 'black';
                                                    }
                                                @endphp
                                                </div>
                                                
                                                    
                                                <span class="badge"
                                                    style="background-color: #a4adf342; border-radius: 10px; color:"></span>
                                            </div> --}}
                                            {{-- <div class="mt-1">
                                                @php
                                                    $statusManagerText = '';
                                                    $textColor = '';

                                                    switch ($leaves->status_coo) {
                                                        case 0:
                                                            $statusCooText = 'Pending';
                                                            $textColor = 'orange';
                                                            break;
                                                        case 1:
                                                            $statusCooText = 'Sedang Direview';
                                                            $textColor = 'blue';
                                                            break;
                                                        case 2:
                                                            $statusCooText = 'Disetujui';
                                                            $textColor = 'green';
                                                            break;
                                                        case 3:
                                                            $statusCooText = 'Ditolak';
                                                            $textColor = 'red';
                                                            break;
                                                        default:
                                                            $statusCooText = 'Undefined';
                                                            $textColor = 'black';
                                                    }
                                                @endphp

                                                <span class="badge"
                                                    style="background-color: #a4adf342; border-radius: 10px; color: {{ $textColor }}">{{ $statusCooText }}</span>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 col-lg-6 mt-3">
                                    {{-- <hr> --}}
                                    <div class="row py-2 px-3" style="background-color: #d8daf242; border-radius: 10px">
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Tanggal Pengajuan
                                            </label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ \Carbon\Carbon::parse($leaves->created_at)->isoFormat('D MMMM Y') }}
                                            </p>

                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Tanggal
                                                Mulai</label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ \Carbon\Carbon::parse($leaves->start_date)->isoFormat('D MMMM Y') }}
                                            </p>

                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Tanggal
                                                Selesai</label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ \Carbon\Carbon::parse($leaves->end_date)->isoFormat('D MMMM Y') }}
                                            </p>
                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Lama
                                            </label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->duration }}
                                            </p>

                                        </div>
                                        <div class="col-md-4 mt-3">
                                            <label class="text-uppercase" style="font-family: monospace;">Alasan
                                            </label><br>
                                            <p style="font-weight: bold; font-family: monospace" class="text-black">
                                                {{ $leaves->reason }}
                                            </p>

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 mt-3">
                                    <div class="py-4 px-4" style="background-color: #d8daf242; border-radius: 10px;">
                                        <h4>Perbarui Status</h4>
                                        <div class="row mt-4">
                                            <div class="col-md-12 text-bold">
                                                <strong>Update {{ $leaves->user->manager->position->name }} :</strong>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                @if ($leaves->status_manager == 0)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif ($leaves->status_manager == 1)
                                                    <span class="badge badge-info">Sedang Direview</span>
                                                @elseif ($leaves->status_manager == 2)
                                                    <span class="badge badge-success">Disetujui</span>
                                                    <span
                                                        class="badge badge-primary">{{ $leaves->manager->full_name }}</span>
                                                    <span class="badge badge-info">
                                                        {{ \Carbon\Carbon::parse($leaves->date_manager)->isoFormat('D MMMM Y') }}
                                                    </span>
                                                @elseif ($leaves->status_manager == 3)
                                                    <span class="badge badge-danger">Ditolak</span>
                                                    <span
                                                        class="badge badge-primary">{{ $leaves->manager->full_name }}</span>
                                                    <span class="badge badge-info">
                                                        {{ \Carbon\Carbon::parse($leaves->date_manager)->isoFormat('D MMMM Y') }}
                                                    </span>
                                                @else
                                                    <span style="color: black;">Undefined</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <strong>Update {{ $leaves->user->coo->position->name }} : </strong>
                                            </div>
                                            <div class="col-md-12 mt-3">
                                                @if ($leaves->status_coo == 0)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif ($leaves->status_coo == 1)
                                                    <span class="badge badge-info">Sedang Direview</span>
                                                @elseif ($leaves->status_coo == 2)
                                                    <span class="badge badge-success">Disetujui</span>
                                                    <span class="badge badge-primary">{{ $leaves->coo->full_name }}</span>
                                                    <span class="badge badge-info">
                                                        {{ \Carbon\Carbon::parse($leaves->date_coo)->isoFormat('D MMMM Y') }}
                                                    </span>
                                                @elseif ($leaves->status_coo == 3)
                                                    <span class="badge badge-danger">Ditolak</span>
                                                    <span class="badge badge-primary">{{ $leaves->coo->full_name }}</span>
                                                    <span class="badge badge-info">
                                                        {{ \Carbon\Carbon::parse($leaves->date_coo)->isoFormat('D MMMM Y') }}
                                                    </span>
                                                @else
                                                    <span style="color: black;">Undefined</span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="text-md-right mt-4 mb-2">
                                            <input type="text" name="action" id="action" class="d-none">
                                            <div class="float-lg-left mb-lg-0 mb-3">
                                                <button class="btn btn-primary btn-icon icon-left action" type="button"
                                                    name="disetujui" data-request-id="{{ $leaves->id }}">
                                                    <i class="fas fa-check"></i>
                                                    Setujui Permohonan
                                                </button>
                                                <button class="btn btn-danger btn-icon icon-left action" type="button"
                                                    name="ditolak" data-request-id="{{ $leaves->id }}">
                                                    <i class="fas fa-times"></i>
                                                    Tolak Permohonan
                                                </button>
                                            </div>
                                            {{-- <button class="btn btn-warning btn-icon icon-left"><i
                                                    class="fas fa-print"></i>
                                                Print</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="row mt-4">
                            @foreach ($types as $type)
                                <div class="col-md-12">
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
                                                    <td class="text-center">{{ $type->duration }} {{ $type->time }}
                                                    </td>
                                                    <td class="text-center">{{ $cutiTerpakaiPerType[$type->id] ?? 0 }}
                                                        {{ $type->time }}</td>
                                                    <td class="text-right">
                                                        {{ $sisaPerType[$type->id] ?? $type->duration }}
                                                        {{ $type->time }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <hr>
                {{-- </form> --}}
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

    {{-- <script>
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
    </script> --}}

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
            $('.action').on('click', function(e) {
                var action = $(this).attr('name');
                $('#action').val(action);
                $("#formEditRequests").submit();
            })

            $("#formEditRequests").on("submit", function(e) {
                e.preventDefault();

                var requestId = $(this).find('button[name="disetujui"], button[name="ditolak"]').data(
                    'request-id');
                console.log(requestId);
                // data: $(this).serialize(),

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
                    url: '{{ route('request-leave.update', ['request_leave' => ':requestId']) }}'
                        .replace(':requestId', requestId),


                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                            }).then(function() {
                                // Redirect ke halaman indeks setelah menutup SweetAlert
                                window.location.href =
                                    '{{ route('request-leave.index') }}';
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
                    }
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('.action').on('click', function(e) {
                var action = $(this).attr('name');
                var requestId = $(this).data('request-id');
    
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
                    url: '{{ route('request-leave.update', ['request_leave' => ':requestId']) }}'
                        .replace(':requestId', requestId),
                    data: {
                        action: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.close();
    
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil diupdate.',
                            }).then(function() {
                                window.location.href = '{{ route('request-leave.index') }}';
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
                                Swal.fire('Gagal', 'Terjadi kesalahan saat memperbarui data', 'error');
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
                            var errorMessage = xhr.responseJSON.message;
                            Swal.fire('Gagal', errorMessage, 'error');
                        }
                    }
                });
            });
        });
    </script> --}}
    
@endsection
