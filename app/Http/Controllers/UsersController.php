<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsersRequest;
use App\Mail\CreateUsers;
use App\Models\Divisions;
use App\Models\Positions;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with(['division', 'position', 'manager', 'role'])
                ->select('users.*');

            return DataTables::of($users)
                ->addColumn('action', function ($users) {
                    return view('pages.admin.users.action', compact('users'));
                })
                ->addColumn('manager_name', function ($users) {
                    return $users->manager ? $users->manager->full_name : '';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.users.index');
    }

    public function getManagers(Request $request)
    {

        $divisionId = $request->input('division_id');

        $managers = User::with('position')->whereHas('position', function ($query) {
            $query->where('level', '!=', 4);
        })->whereHas('division', function ($query) use ($divisionId) {
            $query->where('id', $divisionId);
        })->get();

        return response()->json($managers);
    }

    public function getTopManagers()
    {
        $topManagers = User::with('position')
            ->whereHas('position', function ($query) {
                $query->where('level', 1);
            })
            ->get();

        return response()->json($topManagers);
    }

    // public function getManagers(Request $request)
    // {
    //     $divisionId = $request->input('division_id');
    //     $positionLevel = $request->input('position_level'); // Tambahkan ini

    //     $managers = User::with('position')->whereHas('position', function ($query) use ($positionLevel) {
    //         $query->where('level', '!=', 4);

    //         // Tambahkan ini
    //         if ($positionLevel == 1) {
    //             $query->where('level', '=', 1);
    //         }
    //     })->where(function ($query) use ($divisionId, $positionLevel) {
    //         if ($positionLevel != 1) {
    //             $query->where('division_id', $divisionId);
    //         }

    //         // Tambahkan ini
    //         if ($positionLevel == 1) {
    //             $query->whereNull('division_id');
    //         }
    //     })->pluck('full_name', 'id'); // Menggunakan pluck untuk mendapatkan nilai yang diinginkan

    //     return response()->json($managers);
    // }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $divisions = Divisions::all();
        $positions = Positions::all();
        $managers = User::whereHas('position', function ($query) {
            $query->where('name', '!=', 'Staff');
        })->get();
        $roles = Roles::all();



        return view('pages.admin.users.create', compact('users', 'divisions', 'positions', 'managers', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsersRequest $request)
    {
        $users = new User();
        $users->full_name = $request->input('full_name');
        $users->username = $request->input('username');
        $users->telp = $request->input('telp');
        $users->email = $request->input('email');
        $users->address = $request->input('address');
        $users->entry_date = $request->input('entry_date');
        $users->password = bcrypt($request->input('password'));
        $users->division_id = $request->input('division_id');
        $users->manager_id = $request->input('manager_id');
        $users->position_id = $request->input('position_id');
        $users->role_id = $request->input('role_id');


        if ($users->save()) {
            Mail::to($users->email)->send(new CreateUsers($users));

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $users, string $id)
    {
        $users = User::find($id);
        $divisions = Divisions::all();
        $positions = Positions::all();
        $managers = User::whereHas('position', function ($query) {
            $query->where('name', '!=', 'Staff');
        })->get();
        $roles = Roles::all();


        return view('pages.admin.users.show', compact('users', 'divisions', 'positions', 'managers', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $users, string $id)
    {
        $users = User::find($id);
        $divisions = Divisions::all();
        $positions = Positions::all();
        $roles = Roles::all();
        $managers = User::whereHas('position', function ($query) {
            $query->where('name', '!=', 'Staff');
        })->get();

        return view('pages.admin.users.update', compact('users', 'divisions', 'positions', 'managers', 'roles'));
    }

    // Jika user yang diedit bukan direktur, maka ambil manajer sesuai divisi
    // if ($users->position->level != 1) {
    //     $managers = User::whereHas('position', function ($query) {
    //         $query->where('level', '!=', 4);
    //     })->whereHas('division', function ($query) use ($users) {
    //         $query->where('id', $users->division_id);
    //     })->get();
    // } else {
    //     // Jika user yang diedit adalah direktur, ambil semua manajer
    //     $managers = User::whereHas('position', function ($query) {
    //         $query->where('level', '!=', 4);
    //     })->get();
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);

        $users->update([
            'full_name' => $request->input('full_name'),
            'username' => $request->input('username'),
            'telp' => $request->input('telp'),
            'address' => $request->input('address'),
            'entry_date' => $request->input('entry_date'),
            'division_id' => $request->input('division_id'),
            'position_id' => $request->input('position_id'),
            'manager_id' => $request->input('manager_id'),
            'role_id' => $request->input('role_id'),
            'email' => $request->input('email'),

        ]);

        if ($users->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $users, string $id)
    {
        $users = User::find($id);

        if ($users->delete()) {
            return response()->json(['success' => true, 'message' => 'User berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus User.']);
        }
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashedUsers = User::with(['division', 'position', 'manager', 'role'])
                ->onlyTrashed() // Include soft-deleted records
                ->select('users.*');

            return DataTables::of($trashedUsers)
                ->addColumn('action', function ($users) {
                    return view('pages.admin.users.action', compact('users'));
                })
                ->addColumn('manager_name', function ($users) {
                    return $users->manager ? $users->manager->full_name : '';
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.users.trashed');
    }

    public function restore($id)
    {
        $users = User::onlyTrashed()->find($id);

        if ($users) {
            $users->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $users = User::onlyTrashed()->find($id);

        if ($users) {
            try {
                $users->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus User secara permanen.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan atau tidak dalam status terhapus.']);
        }
    }
}
