<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Permission;

use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PermissionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word,
            'menu_name' => $this->faker->word,
        ];
    }

   

    public function listDivisionPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Divisi',
                'menu_name' => 'Divisions',
                'method' => 'index'
            ];
        });
    }

    public function createDivisionPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Membuat Divisi',
                'menu_name' => 'Divisions',
                'method' => 'create'
            ];
        });
    }

    public function showDivisionsPermissions()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Detail Divisi',
                'menu_name' => 'Divisions',
                'method' => 'show'
            ];
        });
    }

    public function updateDivisionPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Mengedit Divisi',
                'menu_name' => 'Divisions',
                'method' => 'edit'
            ];
        });
    }

    public function deleteDivisionPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Menghapus Divisi',
                'menu_name' => 'Divisions',
                'method' => 'destroy'
            ];
        });
    }

    public function trashedDivisionPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Divisi Terhapus',
                'menu_name' => 'Divisions',
                'method' => 'trashed'
            ];
        });
    }

    public function restoreDivisionPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Restore Divisi',
                'menu_name' => 'Divisions',
                'method' => 'restore'
            ];
        });
    }

    public function forceDelDivisionPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Menghapus Divisi Permanen',
                'menu_name' => 'Divisions',
                'method' => 'force_delete'
            ];
        });
    }

    public function listPositionsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Posisi',
                'menu_name' => 'Positions',
                'method' => 'index'
            ];
        });
    }

    public function createPositionsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Membuat Posisi',
                'menu_name' => 'Positions',
                'method' => 'create'
            ];
        });
    }

    public function showPositionsPermissions()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Detail Posisi',
                'menu_name' => 'Positions',
                'method' => 'show'
            ];
        });
    }

    public function updatePositionsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Mengedit Posisi',
                'menu_name' => 'Positions',
                'method' => 'edit'
            ];
        });
    }

    public function deletePositionsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Mengapus Posisi',
                'menu_name' => 'Positions',
                'method' => 'destroy'
            ];
        });
    }

    public function trashedPositionsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Posisi Terhapus',
                'menu_name' => 'Positions',
                'method' => 'trashed'
            ];
        });
    }

    public function restorePositionsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Restore Posisi',
                'menu_name' => 'Positions',
                'method' => 'restore'
            ];
        });
    }

    public function forceDelPositionsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Mengapus Posisi Permanen',
                'menu_name' => 'Positions',
                'method' => 'force_delete'
            ];
        });
    }

    public function listRolesPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Role',
                'menu_name' => 'Roles',
                'method' => 'index'
            ];
        });
    }

    public function createRolesPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Membuat Role',
                'menu_name' => 'Roles',
                'method' => 'create'
            ];
        });
    }

    public function showRolesPermissions()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Detail Role',
                'menu_name' => 'Roles',
                'method' => 'show'
            ];
        });
    }

    public function updateRolesPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Mengedit Role',
                'menu_name' => 'Roles',
                'method' => 'edit'
            ];
        });
    }

    public function deleteRolesPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Menghapus Role',
                'menu_name' => 'Roles',
                'method' => 'destroy'
            ];
        });
    }
    

    public function listUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Users',
                'menu_name' => 'Users',
                'method' => 'index'
            ];
        });
    }

    public function createUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Membuat Users',
                'menu_name' => 'Users',
                'method' => 'create'
            ];
        });
    }

    public function showUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Detail Users',
                'menu_name' => 'Users',
                'method' => 'show'
            ];
        });
    }

    public function updateUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Mengedit Users',
                'menu_name' => 'Users',
                'method' => 'edit'
            ];
        });
    }

    public function deleteUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Menghapus Users',
                'menu_name' => 'Users',
                'method' => 'destroy'
            ];
        });
    }

    public function trashedUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Users Terhapus',
                'menu_name' => 'Users',
                'method' => 'destroy'
            ];
        });
    }

    public function restoreUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Restore Users',
                'menu_name' => 'Users',
                'method' => 'restore'
            ];
        });
    }

    public function forceDelUsersPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Menghapus Users Permanen',
                'menu_name' => 'Users',
                'method' => 'force_delete'
            ];
        });
    }

    public function dashboardPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Mengakses Dashboard',
                'menu_name' => 'Dashboard',
                'method' => 'index'
            ];
        });
    }

    public function showSettingsPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Setting',
                'menu_name' => 'Settings',
                'method' => 'index'
            ];
        });
    }

    public function listTypesPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Tipe Cuti',
                'menu_name' => 'Types',
                'method' => 'index'
            ];
        });
    }

    public function createTypesPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Membuat Tipe Cuti',
                'menu_name' => 'Types',
                'method' => 'create'
            ];
        });
    }

    public function showTypesPermission()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Melihat Tipe Cuti',
                'menu_name' => 'Types',
                'method' => 'index'
            ];
        });
    }

}
