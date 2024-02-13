<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Permissions;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{

    public function __construct()
    {
        $this->middleware("permission:index roles", ['only' => ['index']]);
        $this->middleware("permission:show roles", ['only' => ['show']]);
        $this->middleware("permission:create roles", ['only' => ['create', 'store']]);
        $this->middleware("permission:edit roles", ['only' => ['edit', 'update']]);
        $this->middleware("permission:delete roles", ['only' => ['destroy']]);
       
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::select('roles.*');

            return DataTables::of($roles)
                ->addColumn('action', function ($roles) {
                    return view('pages.admin.roles.action', compact('roles'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.roles.index');
        // if ($request->ajax()) {
        //     $roles = Roles::select('roles.*');

        //     return DataTables::of($roles)
        //         ->addColumn('permissions', function ($role) {
        //             return view('roles.permissions', compact('role'));
        //         })
        //         ->addColumn('action', function ($role) {
        //             return view('roles.action', compact('role'));
        //         })
        //         ->addIndexColumn()
        //         ->rawColumns(['permissions', 'action'])
        //         ->make(true);
        // }

        // return view('pages.admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $permissions = Permission::all(); // Sesuaikan ini dengan logika Anda untuk mengambil data permissions
        return view('pages.admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolesRequest $request)
    {

        $role = Role::create(['name' => $request->input('name')]);

        // $selectedPermissions = $request->input('permissions', []); 
        $selectedPermissions = $request->permissions;
        // dd($request->all());
        $role->syncPermissions($selectedPermissions);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        return response()->json(['success' => true]);
    }

     // $role = Role::create([
        //     'name' => $request->input('name'),
        // ]);

        // $permissions = $request->input('permissions', []);

        // foreach ($permissions as $permissionId) {
        //     PermissionRole::create([
        //         'role_id' => $role->id,
        //         'permission_id' => $permissionId,
        //     ]);
        // }
    /**
     * Display the specified resource.
     */
    public function show(Role $roles, $id)
    {
        $roles = Role::find($id);
        $permissions = Permission::all(); // Sesuaikan ini dengan model dan metode untuk mendapatkan permissions

        return view('pages.admin.roles.show', compact('roles', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $roles, $id)
    {
        $roles = Role::find($id);
        $permissions = Permission::all(); // Sesuaikan ini dengan model dan metode untuk mendapatkan permissions

        return view('pages.admin.roles.update', [
            'roles' => $roles,
            'id' => $roles->id,
            'name' => $roles->name
        ], compact('roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolesRequest $request, Role $roles, $id)
    {

        try {
            $roles = Role::find($id);
            $roles->name = $request->input('name');
            $roles->save();

            $roles->syncPermissions($request->input('permissions', []));
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    
            return response()->json(['success' => true]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Error updating role.']);

        }


        // if ($request->has('permissions')) {
        //     // Detach relasi yang ada
        //     // $roles->permissions()->detach();

        //     // Attach relasi yang baru
        //     $roles->permissions()->sync($request->input('permissions', []));
        //     // foreach ($permissions as $permissionId => $value) {
        //     //     $permission = Permissions::find($permissionId);

        //     //     if ($permission && $value) {
        //     //         $roles->permissions()->attach($permissionId);
        //     //     }
        //     // }

        // }

        // return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $roles, $id)
    {
        $roles = Role::find($id);

        if ($roles->delete()) {
            return response()->json(['success' => true, 'message' => 'Role berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Role menghapus User.']);
        }
    }

    public function trashed()
    {
    }

    public function restore()
    {
    }

    public function forceDelete()
    {
    }
}
