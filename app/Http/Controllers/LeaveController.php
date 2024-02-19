<?php

namespace App\Http\Controllers;

use App\Events\LeaveApplicationEvent;
use App\Models\Leave;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Mail\LeaveCOONotification;
use App\Mail\LeaveManagerNotification;
use App\Mail\LeaveRequest;
use App\Models\Divisions;
use App\Models\Positions;
use App\Models\Role;
use App\Models\Type;
use App\Models\User;
use App\Notifications\LeaveApplicationNotification;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;


class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware("check.position.level");
        $this->middleware("permission:index leaves", ['only' => ['index']]);
        $this->middleware("permission:show leaves", ['only' => ['show']]);
        $this->middleware("permission:create leaves", ['only' => ['create', 'store']]);
        $this->middleware("permission:edit leaves", ['only' => ['edit', 'update']]);
        $this->middleware("permission:delete leaves", ['only' => ['destroy']]);
        $this->middleware("permission:trashed leaves", ['only' => ['trashed']]);
        $this->middleware("permission:restore leaves", ['only' => ['restore']]);
        $this->middleware("permission:force-delete leaves", ['only' => ['forceDelete']]);
    }

    public function index(Request $request)
    {



        if ($request->ajax()) {
            $user_id = Auth::id(); // Get the user_id of the logged-in user

            $leaves = Leave::with(['user', 'type'])
                ->where('user_id', $user_id)
                ->select('leaves.*');

            return DataTables::of($leaves)
                ->addColumn('action', function ($leaves) {
                    return view('pages.admin.leaves.action', compact('leaves'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.leaves.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    // public function getLeaveType($id)
    // {
    //     $leaves = Leave::findOrFail($id); // Mengambil jenis cuti berdasarkan ID
    //     return response()->json(['max_leave' => $leaves->max_leave]);
    // }

    public function validateLeave(Request $request)
    {
        $user_id = auth()->user()->id;
        $type_id = $request->input('type_id');
        $duration = $request->input('duration');

        // Menghitung sisa cuti
        $sisaCuti = Type::find($type_id)->duration_in_days - Leave::where('user_id', $user_id)
            ->where('status_manager', 2)
            ->where('status_coo', 2)
            ->where('type_id', $type_id)
            ->sum('duration');

        // Validasi
        if ($duration > $sisaCuti) {
            return response()->json(['status' => 'error', 'message' => 'Jumlah Cuti yang diambil melebihi sisa cuti yang tersedia']);
        }

        if ($duration == $sisaCuti) {
            return response()->json(['status' => 'error', 'message' => 'Jumlah cuti yang tersedia tidak boleh digunakan dalam 1 waktu']);
        }

        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        $leaves = Leave::with('type')->get();

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

        return view('pages.admin.leaves.create', compact('types', 'users', 'positions', 'divisions', 'roles', 'managers', 'cutiTerpakaiPerType', 'sisaPerType', 'totalDurasi'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequest $request)
    {
        $userLevel = auth()->user()->position->level;
        $user = auth()->user();


        $statusManager = 0;
        $statusCoo = 0;

        if ($userLevel == 4) {
            $statusManager = 0;
            $statusCoo = 0;
        } elseif ($userLevel == 3) {
            $statusManager = 2;
            $statusCoo = 0;
        }

        $leaves = new Leave([
            'user_id' => $request->input('user_id'),
            'type_id' => $request->input('type_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'duration' => $request->input('duration'),
            'reason' => $request->input('reason'),
            'status_manager' => $statusManager,
            'status_coo' => $statusCoo,
        ]);

        if ($leaves->save()) {
            $managerId = $user->manager_id;

            $cooId = $user->coo_id ?? null;
            $userLevel = $user->position->level;

            // Kirim email user, manager, coo
            Mail::to($leaves->user->email)->send(new LeaveRequest($leaves, $user));
            Mail::to($leaves->user->manager->email)->send(new LeaveManagerNotification($leaves, $user));
            if ($userLevel != 3 && $cooId) {
                Mail::to($leaves->user->coo->email)->send(new LeaveCOONotification($leaves, $user));
            }
            return response()->json(['success' => true]);
        }
    }



    public function getDuration($id)
    {
        $type = Type::findOrFail($id);

        return response()->json(['duration' => $type->duration]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave, $slug)
    {
        //
        // $leaves = Leave::find($slug);
        $leaves = Leave::where('slug', $slug)->first();


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

        return view('pages.admin.leaves.show', compact('leaves', 'types', 'users', 'positions', 'divisions', 'roles', 'managers', 'cutiTerpakaiPerType', 'sisaPerType', 'totalDurasi'));
    }

    public function exportPDF($slug)
    {
        $leaves = Leave::where('slug', $slug)->first();
        // dd($leaves);
        $pdf = Pdf::loadView('pages.admin.leaves.pdf', compact('leaves'));

        return $pdf->download('pengajuan_cuti.pdf');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave, $slug)
    {
        //


        $leaves = Leave::where('slug', $slug)->first();

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


        // if ($users->leave->status_manager == 1) {
        //     return redirect()->route('users.index')->with('error', 'Anda tidak dapat mengedit pengajuan ini karena sudah disetujui oleh manager.');
        // }

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

        return view('pages.admin.leaves.update', compact('leaves', 'types', 'users', 'positions', 'divisions', 'roles', 'managers', 'cutiTerpakaiPerType', 'sisaPerType', 'totalDurasi'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function inReview()
    {
        // $status_manager = ;
        // $status_coo = ;
    }
    public function update(UpdateLeaveRequest $request, $id)
    {
        $leaves = Leave::find($id);

        $leaves->update([
            'user_id' => $request->input('user_id'),
            'type_id' => $request->input('type_id'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'duration' => $request->input('duration'),
            'reason' => $request->input('reason'),
        ]);

        if ($leaves->save()) {
            return response()->json(['success' => true]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave, $slug)
    {
        $leave = Leave::where('slug', $slug)->first();

        if ($leave->delete()) {
            return response()->json(['success' => true, 'message' => 'Pengajuan berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus Pengajuan.']);
        }
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashedLeaves = Leave::with(['user', 'type'])
                ->onlyTrashed()
                ->select('leaves.*');
            // $trashedLeaves = Leave::onlyTrashed();

            return DataTables::of($trashedLeaves)
                ->addColumn('action', function ($leaves) {
                    return view('pages.admin.leaves.action', compact('leaves'));
                })

                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.leaves.trashed');
    }

    public function restore($slug)
    {
        $leaves = Leave::withTrashed()->where('slug', $slug)->first();

        if ($leaves) {
            $leaves->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($slug)
    {
        $leaves = Leave::withTrashed()->where('slug', $slug)->first();

        if ($leaves) {
            try {
                $leaves->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus Pengajuan secara permanen.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Pengajuan tidak ditemukan atau tidak dalam status terhapus.']);
        }
    }
}
