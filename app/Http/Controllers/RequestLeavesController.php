<?php

namespace App\Http\Controllers;

use App\Mail\LeaveCOOUpdate;
use App\Mail\LeaveManagerUpdate;
use App\Mail\ManagerApproveToCOO;
use App\Models\Divisions;
use App\Models\Leave;
use App\Models\Positions;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class RequestLeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $user = auth()->user()->id;


            $leaves = Leave::with(['user', 'type'])
                ->join('users', 'users.id', '=', 'leaves.user_id') // Join with users table
                ->select('leaves.*')
                ->where(function ($query) use ($user) {
                    $query->where('users.manager_id', $user)
                        ->orWhere('users.coo_id', $user);
                });


            return DataTables::of($leaves)
                ->addColumn('action', function ($leaves) {
                    return view('pages.admin.request.action', compact('leaves'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.request.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave, $id)
    {
        //
        $leaves = Leave::with(['user', 'type'])->findOrFail($id);

        $userLevel = auth()->user()->position->level;

        $users = User::all();
        $types = Type::all();
        $divisions = Divisions::all();
        $positions = Positions::all();
        $managers = User::whereHas('position', function ($query) {
            $query->where('name', '!=', 'Staff');
        })->get();
        $roles = Role::all();

        $user_id = $leaves->user_id;

        $totalDurasi = 0;

        $cutiTerpakaiPerType = [];
        $cutiSedangDiprosesPerType = [];

        foreach ($types as $type) {

            // Menambahkan durasi jenis cuti ke totalDurasi
            $totalDurasi += $type->duration_in_days;

            $cutiTerpakai = Leave::where('user_id', $user_id)
                ->where('status_manager', 2)
                ->where('status_coo', 2)
                ->where('type_id', $type->id)
                ->sum('duration');

            $cutiTerpakaiPerType[$type->id] = $cutiTerpakai;

            $sedangDiproses = Leave::where('user_id', $user_id)
                ->where(function ($query) {
                    $query->whereNotIn('status_manager', [2, 3])
                        ->orWhereNotIn('status_coo', [2, 3]);
                })
                ->where('type_id', $type->id)
                ->sum('duration');

            $sedangDiprosesPerType[$type->id] = $sedangDiproses;

            // dd($sedangDiprosesPerType);

        }

        $sisaPerType = [];

        foreach ($types as $type) {

            $sisa = $type->duration_in_days - ($cutiTerpakaiPerType[$type->id] ?? 0);
            $sisaPerType[$type->id] = $sisa;

            $cutiTersedia = $sisa - ($sedangDiprosesPerType[$type->id] ?? 0);
            $cutiTersediaPerType[$type->id] = $cutiTersedia;

           
        }

        return view('pages.admin.request.show', compact('leaves', 'types', 'users', 'positions', 'divisions', 'roles', 'managers', 'cutiTerpakaiPerType',  'sedangDiprosesPerType', 'cutiTersediaPerType', 'sisaPerType', 'totalDurasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave, $id)
    {
        //
        $leaves = Leave::with(['user', 'type'])->findOrFail($id);

        // if (($leave->status_manager == 0 || $leave->status_manager == 1) && !auth()->user()->can('edit leaves')) {
        //     abort(403, 'Unauthorized action.');
        // }

        // if (($leave->status_coo == 0 || $leave->status_coo == 1) && !auth()->user()->can('edit leaves')) {
        //     abort(403, 'Unauthorized action.');
        // }

        // if (($leave->status_manager == 2 || $leave->status_coo == 0) && !auth()->user()->can('edit leaves')) {
        //     abort(403, 'Unauthorized action.');
        // }
        $userLevel = auth()->user()->position->level;

        $users = User::all();
        $types = Type::all();
        $divisions = Divisions::all();
        $positions = Positions::all();
        $managers = User::whereHas('position', function ($query) {
            $query->where('name', '!=', 'Staff');
        })->get();
        $roles = Role::all();

        $user_id = auth()->user()->id;

        $totalDurasi = 0;

        $cutiTerpakaiPerType = [];

        foreach ($types as $type) {

            // Menambahkan durasi jenis cuti ke totalDurasi
            $totalDurasi += $type->duration_in_days;

            $cutiTerpakai = Leave::where('user_id', $user_id)
                ->where('status_manager', 2)
                ->where('status_coo', 2)
                ->where('type_id', $type->id)
                ->sum('duration');

            $cutiTerpakaiPerType[$type->id] = $cutiTerpakai;
        }

        $sisaPerType = [];

        foreach ($types as $type) {

            // Menghitung sisa cuti untuk jenis cuti saat ini
            $sisa = $type->duration_in_days - ($cutiTerpakaiPerType[$type->id] ?? 0);
            $sisaPerType[$type->id] = $sisa;
        }
        if ($userLevel == 3 && $leaves->status_manager == 0) {
            $leaves->status_manager = 1;
            $leaves->save();
        }

        if ($userLevel == 2 && $leaves->status_coo == 0) {
            $leaves->status_coo = 1;
            $leaves->save();
        }

        return view('pages.admin.request.update', compact('leaves', 'types', 'users', 'positions', 'divisions', 'roles', 'managers', 'cutiTerpakaiPerType', 'sisaPerType', 'totalDurasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leaves = Leave::find($id);

        $userLevel = auth()->user()->position->level;

        if ($userLevel == 3) {
            if ($request->action == 'disetujui') {
                $leaves->status_manager = 2;
                $leaves->manager_id = auth()->user()->id;
                $leaves->date_manager = now();
                $leaves->status_coo = 0;
                $leaves->coo_id = null;
                $leaves->date_coo = null;
            } elseif ($request->action == 'ditolak') {
                $leaves->status_manager = 3;
                $leaves->manager_id = auth()->user()->id;
                $leaves->date_manager = now();
                $leaves->status_coo = 3;
                $userId = $leaves->user_id;
                $user = User::find($userId);
                $managerId = $user->manager_id;
                $cooUser = User::find($managerId);
                $leaves->coo_id = $cooUser->manager_id;
                $leaves->date_coo = now();

            }

            Mail::to($leaves->user->email)->send(new LeaveManagerUpdate($leaves));
            if ($leaves->status_manager == 2 && $leaves->user->coo) {
                Mail::to($leaves->user->coo->email)->send(new ManagerApproveToCOO($leaves));
            }
        } elseif ($userLevel == 2) {
            if ($request->action == 'disetujui') {
                $leaves->status_coo = 2;
                $leaves->coo_id = auth()->user()->id;
                $leaves->date_coo = now();
            } elseif ($request->action == 'ditolak') {
                $leaves->status_coo = 3;
                $leaves->coo_id = auth()->user()->id;
                $leaves->date_coo = now();
            }

            Mail::to($leaves->user->email)->send(new LeaveCOOUpdate($leaves));
        }

        if ($leaves->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);

        }
        // $leaves->save();
        // return redirect()->route('request-leave.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
