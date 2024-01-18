<?php

namespace Database\Seeders;

use App\Models\Permissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //


        Permissions::factory()->listDivisionPermission()->create();
        Permissions::factory()->createDivisionPermission()->create();
        Permissions::factory()->showDivisionsPermissions()->create();
        Permissions::factory()->updateDivisionPermission()->create();
        Permissions::factory()->deleteDivisionPermission()->create();
        Permissions::factory()->trashedDivisionPermission()->create();
        Permissions::factory()->restoreDivisionPermission()->create();
        Permissions::factory()->forceDelDivisionPermission()->create();

        Permissions::factory()->listPositionsPermission()->create();
        Permissions::factory()->createPositionsPermission()->create();
        Permissions::factory()->showPositionsPermissions()->create();
        Permissions::factory()->updatePositionsPermission()->create();
        Permissions::factory()->deletePositionsPermission()->create();
        Permissions::factory()->trashedPositionsPermission()->create();
        Permissions::factory()->restorePositionsPermission()->create();
        Permissions::factory()->forceDelPositionsPermission()->create();

       

        Permissions::factory()->listUsersPermission()->create();
        Permissions::factory()->createUsersPermission()->create();
        Permissions::factory()->showUsersPermission()->create();
        Permissions::factory()->updateUsersPermission()->create();
        Permissions::factory()->deleteUsersPermission()->create();
        Permissions::factory()->trashedUsersPermission()->create();
        Permissions::factory()->restoreUsersPermission()->create();
        Permissions::factory()->forceDelUsersPermission()->create();

        Permissions::factory()->listRolesPermission()->create();
        Permissions::factory()->createRolesPermission()->create();
        Permissions::factory()->showRolesPermissions()->create();
        Permissions::factory()->updateRolesPermission()->create();
        Permissions::factory()->deleteRolesPermission()->create();

        Permissions::factory()->showSettingsPermission()->create();
        Permissions::factory()->dashboardPermission()->create();

    }
}
