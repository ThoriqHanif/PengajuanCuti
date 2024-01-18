@extends('layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('roles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail Role {{$roles->name}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></div>
                    <div class="breadcrumb-item">Detail Role {{$roles->name}}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Detail Role</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ url('roles.show', $roles->id) }}" enctype="multipart/form-data"
                                    id="formRoles">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama
                                            Role</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text" class="form-control" name="name" id="name"
                                                value="{{ $roles->name }}" readonly>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Hak Akses</h4>
                </div>
                <div class="card-body">
                    
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
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                    class="custom-switch-input permission-checkbox"
                                                    {{ in_array($permission->id, $roles->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
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
            </div>
            </form>

        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Ambil semua elemen checkbox dengan kelas 'permission-checkbox'
            var checkboxes = document.querySelectorAll('.permission-checkbox');

            // Matikan semua checkbox
            checkboxes.forEach(function (checkbox) {
                checkbox.disabled = true;
            });
        });
    </script>
@endsection
