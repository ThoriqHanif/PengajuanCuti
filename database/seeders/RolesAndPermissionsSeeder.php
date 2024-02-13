<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'index divisions', 'alias' => 'Melihat Divisi', 'menu_name' => 'Divisions', 'guard_name' => 'web']);
        Permission::create(['name' => 'show divisions', 'alias' => 'Melihat Detail Divisi', 'menu_name' => 'Divisions', 'guard_name' => 'web']);
        Permission::create(['name' => 'create divisions', 'alias' => 'Membuat Divisi', 'menu_name' => 'Divisions', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit divisions', 'alias' => 'Mengedit Divisi', 'menu_name' => 'Divisions', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete divisions', 'alias'=> 'Menghapus Divisi', 'menu_name' => 'Divisions', 'guard_name' => 'web']);
        Permission::create(['name' => 'trashed divisions', 'alias'=> 'Melihat Divisi Terhapus', 'menu_name' => 'Divisions', 'guard_name' => 'web']);
        Permission::create(['name' => 'restore divisions', 'alias' => 'Mengembalikan Divisi', 'menu_name' => 'Divisions', 'guard_name' => 'web']);
        Permission::create(['name' => 'force-delete divisions', 'alias' => 'Menghapus Permanen Divisi', 'menu_name' => 'Divisions', 'guard_name' => 'web']);

        Permission::create(['name' => 'index positions', 'alias' => 'Melihat Posisi', 'menu_name' => 'Positions', 'guard_name' => 'web']);
        Permission::create(['name' => 'show positions', 'alias' => 'Melihat Detail Posisi', 'menu_name' => 'Positions', 'guard_name' => 'web']);
        Permission::create(['name' => 'create positions', 'alias' => 'Membuat Posisi', 'menu_name' => 'Positions', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit positions', 'alias' => 'Mengedit Posisi', 'menu_name' => 'Positions', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete positions', 'alias' => 'Menghapus Posisi', 'menu_name' => 'Positions', 'guard_name' => 'web']);
        Permission::create(['name' => 'trashed positions', 'alias' => 'Melihat Posisi Terhapus', 'menu_name' => 'Positions', 'guard_name' => 'web']);
        Permission::create(['name' => 'restore positions', 'alias' => 'Mengembalikan Posisi', 'menu_name' => 'Positions', 'guard_name' => 'web']);
        Permission::create(['name' => 'force-delete positions', 'alias' => 'Menghapus Permanen Posisi', 'menu_name' => 'Positions', 'guard_name' => 'web']);

        Permission::create(['name' => 'index roles', 'alias' => 'Melihat Role', 'menu_name' => 'Roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'show roles', 'alias' => 'Melihat Detail Role', 'menu_name' => 'Roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'create roles', 'alias' => 'Membuat Role', 'menu_name' => 'Roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit roles', 'alias' => 'Mengedit Role', 'menu_name' => 'Roles', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete roles', 'alias' => 'Menghapus Role', 'menu_name' => 'Roles', 'guard_name' => 'web']);

        Permission::create(['name' => 'index users', 'alias' => 'Melihat User', 'menu_name' => 'Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'show users', 'alias' => 'Melihat Detail User', 'menu_name' => 'Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'create users', 'alias' => 'Membuat User', 'menu_name' => 'Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit users', 'alias' => 'Mengedit User', 'menu_name' => 'Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete users', 'alias' => 'Menghapus User', 'menu_name' => 'Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'trashed users', 'alias' => 'Melihat User Terhapus', 'menu_name' => 'Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'restore users', 'alias' => 'Mengembalikan User', 'menu_name' => 'Users', 'guard_name' => 'web']);
        Permission::create(['name' => 'force-delete users', 'alias' => 'Menghapus Permanen User', 'menu_name' => 'Users', 'guard_name' => 'web']);

        Permission::create(['name' => 'index types', 'alias' => 'Melihat Tipe', 'menu_name' => 'Types', 'guard_name' => 'web']);
        Permission::create(['name' => 'show types', 'alias' => 'Melihat Detail Tipe', 'menu_name' => 'Types', 'guard_name' => 'web']);
        Permission::create(['name' => 'create types', 'alias' => 'Membuat Tipe', 'menu_name' => 'Types', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit types', 'alias' => 'Mengedit Tipe', 'menu_name' => 'Types', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete types', 'alias' => 'Menghapus Tipe', 'menu_name' => 'Types', 'guard_name' => 'web']);
        Permission::create(['name' => 'trashed types', 'alias' => 'Melihat Tipe Terhapus', 'menu_name' => 'Types', 'guard_name' => 'web']);
        Permission::create(['name' => 'restore types', 'alias' => 'Mengembalikan Tipe', 'menu_name' => 'Types', 'guard_name' => 'web']);
        Permission::create(['name' => 'force-delete types', 'alias' => 'Menghapus Permanen Tipe', 'menu_name' => 'Types', 'guard_name' => 'web']);

        Permission::create(['name' => 'index leaves', 'alias' => 'Melihat Pengajuan', 'menu_name' => 'Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'show leaves', 'alias' => 'Melihat Detail Pengajuan', 'menu_name' => 'Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'create leaves', 'alias' => 'Membuat Pengajuan', 'menu_name' => 'Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit leaves', 'alias' => 'Mengedit Pengajuan', 'menu_name' => 'Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete leaves', 'alias' => 'Menghapus Pengajuan', 'menu_name' => 'Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'trashed leaves', 'alias' => 'Melihat Pengajuan Terhapus', 'menu_name' => 'Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'restore leaves', 'alias' => 'Mengembalikan Pengajuan', 'menu_name' => 'Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'force-delete leaves', 'alias' => 'Menghapus Permanen Pengajuan', 'menu_name' => 'Leaves', 'guard_name' => 'web']);

        Permission::create(['name' => 'index request-leave', 'alias' => 'Melihat Permohonan', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'show request-leave', 'alias' => 'Melihat Detail Permohonan', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'create request-leave', 'alias' => 'Membuat Permohonan', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit request-leave', 'alias' => 'Mengedit Permohonan', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete request-leave', 'alias' => 'Menghapus Permohonan', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'trashed request-leave', 'alias' => 'Melihat Permohonan Terhapus', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'restore request-leave', 'alias' => 'Mengembalikan Permohonan', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);
        Permission::create(['name' => 'force-delete request-leave', 'alias' => 'Menghapus Permanen Permohonan', 'menu_name' => 'Request Leaves', 'guard_name' => 'web']);

        Permission::create(['name' => 'index profile', 'alias' => 'Melihat Profile', 'menu_name' => 'Profile', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit profile', 'alias' => 'Mengedit Profile', 'menu_name' => 'Profile', 'guard_name' => 'web']);


        $role = Role::create(['name' => 'superadmin']);
        $role->givePermissionTo(Permission::all());
    }
}
