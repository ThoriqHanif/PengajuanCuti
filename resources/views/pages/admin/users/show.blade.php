@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail {{$users->username}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></div>
                    <div class="breadcrumb-item">Detail User</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail User</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.show', $users->id) }}" enctype="multipart/form-data"
                                    id="formUsers">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Lengkap <span class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="full_name" id="full_name"
                                                placeholder="eg. John Doe" value="{{$users->full_name}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Panggilan <span class="text-danger"> *</span></label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="eg. John" value="{{$users->username}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat</label>
                                        <div class="col-sm-12 col-md-7">
                                            <textarea class="form-control" placeholder="" readonly>{{$users->address}}</textarea>
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
                                                    id="entry_date" value="{{$users->entry_date}}" disabled>
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
                                                    id="telp" placeholder="081xxxxxxx" value="{{$users->telp}}" readonly>
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
                                                    id="email" placeholder="eg. john@gmail.com" value="{{$users->email}}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                        {{-- <div class="form-group row mb-4">
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
                                                    <input type="password" name="password" id="password"
                                                        class="form-control pwstrength" value="{{$users->password}}">
                                                </div>
                                            </div>
                                        </div> --}}
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Posisi <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="position_id" id="position_id" disabled>
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
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Divisi <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="division_id" id="division_id" disabled>
                                                <option value="" selected>Pilih Divisi</option>
                                                @foreach ($divisions as $division)
                                                    <option value="{{ $division->id }}" {{$users->division_id == $division->id ? 'selected' : ''}}>
                                                        {{ $division->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4 manager-row" id="managerField"
                                        >
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Manager <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control selectric" name="manager_id" id="managerSelect" disabled>
                                                <option value="" selected>Pilih Manager</option>
                                                @foreach ($managers as $manager)
                                                    <option value="{{ $manager->id }}" {{$users->manager_id == $manager->id ? 'selected' : ''}}>
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
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{$users->role_id == $role->id ? 'selected' : ''}}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                        <div class="col-sm-12 col-md-7">
                                            <button type="submit" class="btn btn-primary">Create Users</button>
                                        </div>
                                    </div> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            </form>

        </section>
    </div>


@endsection
