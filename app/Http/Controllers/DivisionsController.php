<?php

namespace App\Http\Controllers;

use App\Models\Divisions;
use App\Http\Requests\StoreDivisionsRequest;
use App\Http\Requests\UpdateDivisionsRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DivisionsController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:index divisions", ['only' => ['index']]);
        $this->middleware("permission:show divisions", ['only' => ['show']]);
        $this->middleware("permission:create divisions", ['only' => ['create', 'store']]);
        $this->middleware("permission:edit divisions", ['only' => ['edit', 'update']]);
        $this->middleware("permission:delete divisions", ['only' => ['destroy']]);
        $this->middleware("permission:trashed divisions", ['only' => ['trashed']]);
        $this->middleware("permission:restore divisions", ['only' => ['restore']]);
        $this->middleware("permission:force-delete divisions", ['only' => ['forceDelete']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $divisions = Divisions::select('divisions.*');
            
            return DataTables::of($divisions)
                ->addColumn('action', function ($divisions) {
                    return view('pages.admin.divisions.action', compact('divisions'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        // dd(auth()->user()->roles()->first()->permissions->pluck('id'));

        return view('pages.admin.divisions.index');
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
    public function store(StoreDivisionsRequest $request)
    {
        //
        $divisions = new Divisions();
        // $periode->user_id = null;
        $divisions->name = $request->name;

        if ($divisions->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisions $divisions, $id)
    {
        $divisions = Divisions::find($id);

        return response()->json(['result' => $divisions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Divisions $divisions, $id)
    {
        $divisions = Divisions::find($id);

        return response()->json(['result' => $divisions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDivisionsRequest $request, Divisions $divisions, $id)
    {
        //
        $divisions = Divisions::find($id);

        $divisions->update([
            'name' => $request->input('name'),
        ]);

        // Simpan perubahan 
        if ($divisions->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $divisions = Divisions::find($id);

        if ($divisions->delete()) {
            return response()->json(['success' => true, 'message' => 'Divisi berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus Divisi.']);
        }
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashedDivisions = Divisions::onlyTrashed();

            return DataTables::of($trashedDivisions)
                ->addColumn('action', function ($divisions) {
                    return view('pages.admin.divisions.action', compact('divisions'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.divisions.trashed');
    }



    public function restore($id)
    {
        $divisions = Divisions::onlyTrashed()->find($id);

        if ($divisions) {
            $divisions->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $divisions = Divisions::onlyTrashed()->find($id);

        if ($divisions) {
            try {
                $divisions->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus Divisi secara permanen.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Divisi tidak ditemukan atau tidak dalam status terhapus.']);
        }
    }
}
