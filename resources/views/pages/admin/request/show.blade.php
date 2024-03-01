@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('request-leave.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail Permohonan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('request-leave.index') }}">Permohonan</a></div>
                    <div class="breadcrumb-item">Detail Permohonan Cuti</div>
                </div>
            </div>

            <div class="section-body">
                <form method="POST" action="{{ route('request-leave.show', ['request_leave' => $leaves->id]) }}"
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
                                <div class="col-md-8 col-lg-8 mt-3">
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
                                        <div class="col-md-3 mt-3">
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
                                                <img alt="image"
                                                    src="{{ asset('files/photo/' . $leaves->user->photo) }}" class=""
                                                    width="100" style="border-radius: 10px">
                                            @else
                                                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}"
                                                    class="" width="100" style="border-radius: 10px">
                                            @endif

                                            
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
                                                {{ $leaves->duration }} hari
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
                                        <h4>Informasi Status</h4>
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
                                                    <div class="row center">

                                                        <div class="col-lg-auto col-md-12 mb-2">

                                                            <span class="badge badge-success">Disetujui</span>
                                                        </div>

                                                        <div class="col-lg-auto col-md-12 mb-2">
                                                            <span
                                                                class="badge badge-primary">{{ $leaves->manager->full_name }}</span>

                                                        </div>
                                                        <div class="col-lg-auto col-md-12">
                                                            <span class="badge badge-info">
                                                                {{ \Carbon\Carbon::parse($leaves->date_manager)->isoFormat('D MMMM Y') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                @elseif ($leaves->status_manager == 3)
                                                <div class="row">

                                                    <div class="col-lg-12 col-md-12 mb-2">

                                                        <span class="badge badge-danger">Ditolak</span>
                                                    </div>

                                                    <div class="col-lg-12 col-md-12 mb-2">
                                                        <span
                                                            class="badge badge-primary">{{ $leaves->manager->full_name }}</span>

                                                    </div>
                                                    <div class="col-lg-12 col-md-12">
                                                        <span class="badge badge-info">
                                                            {{ \Carbon\Carbon::parse($leaves->date_manager)->isoFormat('D MMMM Y') }}
                                                        </span>
                                                    </div>
                                                </div>
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
                                                <div class="row center">

                                                    <div class="col-lg-auto col-md-12 mb-2">

                                                        <span class="badge badge-success">Disetujui</span>
                                                    </div>

                                                    <div class="col-lg-auto col-md-12 mb-2">
                                                        <span
                                                            class="badge badge-primary">{{ $leaves->coo->full_name }}</span>

                                                    </div>
                                                    <div class="col-lg-auto col-md-12">
                                                        <span class="badge badge-info">
                                                            {{ \Carbon\Carbon::parse($leaves->date_coo)->isoFormat('D MMMM Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @elseif ($leaves->status_coo == 3)
                                                <div class="row center">

                                                    <div class="col-lg-auto col-md-12 mb-2">

                                                        <span class="badge badge-danger">Ditolak</span>
                                                    </div>

                                                    <div class="col-lg-auto col-md-12 mb-2">
                                                        <span
                                                            class="badge badge-primary">{{ $leaves->coo->full_name }}</span>

                                                    </div>
                                                    <div class="col-lg-auto col-md-12">
                                                        <span class="badge badge-info">
                                                            {{ \Carbon\Carbon::parse($leaves->date_coo)->isoFormat('D MMMM Y') }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @else
                                                    <span style="color: black;">Undefined</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- <div class="text-md-right mt-4 mb-2">
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
                                            <button class="btn btn-warning btn-icon icon-left"><i
                                                    class="fas fa-print"></i>
                                                Print</button>
                                        </div> --}}
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
                                                    <th class="text-center">Total Cuti</th>
                                                    <th class="text-center">Cuti Tersedia</th>
                                                    <th class="text-center">Sedang Diproses</th>
                                                    <th class="text-center">Terpakai</th>
                                                    <th class="text-right">Total Sisa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>{{ \Carbon\Carbon::parse($type->created_at)->format('Y') }}</td>
                                                    <td class="text-center">{{ $type->duration }} {{ $type->time }}</td>
                                                    <td class="text-center">{{ $cutiTersediaPerType[$type->id] ?? $sisaPerType[$type->id] }} hari</td>
                                                    <td class="text-center">{{ $sedangDiprosesPerType[$type->id] ?? 0 }} hari</td>
                                                    <td class="text-center">{{ $cutiTerpakaiPerType[$type->id] ?? 0 }} hari</td>
                                                    <td class="text-right">{{ $sisaPerType[$type->id] ?? $type->duration_in_days }} hari</td>
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
@endsection
