<?php

namespace App\Http\Controllers;

use App\Models\Positions;
use App\Http\Requests\StorePositionsRequest;
use App\Http\Requests\UpdatePositionsRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware("permission:index positions", ['only' => ['index']]);
         $this->middleware("permission:show positions", ['only' => ['show']]);
         $this->middleware("permission:create positions", ['only' => ['create', 'store']]);
         $this->middleware("permission:edit positions", ['only' => ['edit', 'update']]);
         $this->middleware("permission:delete positions", ['only' => ['destroy']]);
         $this->middleware("permission:trashed positions", ['only' => ['trashed']]);
         $this->middleware("permission:restore positions", ['only' => ['restore']]);
         $this->middleware("permission:force-delete positions", ['only' => ['forceDelete']]);
     }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $positions = Positions::select('positions.*');
            
            return DataTables::of($positions)
                ->addColumn('action', function ($positions) {
                    return view('pages.admin.positions.action', compact('positions'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.positions.index');
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
    public function store(StorePositionsRequest $request)
    {
        $positions = new Positions();
        // $periode->user_id = null;
        $positions->name = $request->name;
        $positions->level = $request->level;

        if ($positions->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Positions $positions, $id)
    {
        $positions = Positions::find($id);

        return response()->json(['result' => $positions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Positions $positions, $id)
    {
        $positions = Positions::find($id);

        return response()->json(['result' => $positions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePositionsRequest $request, Positions $positions, $id)
    {
        //
        $positions = Positions::find($id);

        $positions->update([
            'name' => $request->input('name'),
            'level' => $request->input('level')
        ]);

        // Simpan perubahan 
        if ($positions->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Positions $positions, $id)
    {
        $positions = Positions::find($id);

        if ($positions->delete()) {
            return response()->json(['success' => true, 'message' => 'Posisi berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus Posisi.']);
        }
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashedPositions = Positions::onlyTrashed();

            return DataTables::of($trashedPositions)
                ->addColumn('action', function ($positions) {
                    return view('pages.admin.positions.action', compact('positions'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.positions.trashed');
    }

    public function restore($id)
    {
        $positions = Positions::onlyTrashed()->find($id);

        if ($positions) {
            $positions->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $positions = Positions::onlyTrashed()->find($id);

        if ($positions) {
            try {
                $positions->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus Posisi secara permanen.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Divisi tidak ditemukan atau tidak dalam status terhapus.']);
        }
    }
}
