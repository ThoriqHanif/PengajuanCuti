<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Models\PermissionRole;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Roles::select('roles.*');

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
        $permissions = Permissions::all(); // Sesuaikan ini dengan logika Anda untuk mengambil data permissions
        return view('pages.admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolesRequest $request)
    {

        $role = Roles::create([
            'name' => $request->input('name'),
        ]);

        $permissions = $request->input('permissions', []);

        foreach ($permissions as $permissionId) {
            PermissionRole::create([
                'role_id' => $role->id,
                'permission_id' => $permissionId,
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Roles $roles, $id)
    {
        $roles = Roles::find($id);
        $permissions = Permissions::all(); // Sesuaikan ini dengan model dan metode untuk mendapatkan permissions

        return view('pages.admin.roles.show', compact('roles', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Roles $roles, $id)
    {
        $roles = Roles::find($id);
        $permissions = Permissions::all(); // Sesuaikan ini dengan model dan metode untuk mendapatkan permissions

        return view('pages.admin.roles.update', [
            'roles' => $roles,
            'id' => $roles->id,
            'name' => $roles->name
        ], compact('roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolesRequest $request, Roles $roles, $id)
    {

        try {
            $roles = Roles::find($id);
            $roles->name = $request->input('name');
            $roles->save();
    
            if ($request->has('permissions')) {
                $roles->permissions()->sync($request->input('permissions', []));
            }
    
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
    public function destroy(Roles $roles, $id)
    {
        $roles = Roles::find($id);

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
