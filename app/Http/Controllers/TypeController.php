<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends Controller
{

    public function __construct()
     {
         $this->middleware("permission:index types", ['only' => ['index']]);
         $this->middleware("permission:show types", ['only' => ['show']]);
         $this->middleware("permission:create types", ['only' => ['create', 'store']]);
         $this->middleware("permission:edit types", ['only' => ['edit', 'update']]);
         $this->middleware("permission:delete types", ['only' => ['destroy']]);
         $this->middleware("permission:trashed types", ['only' => ['trashed']]);
         $this->middleware("permission:restore types", ['only' => ['restore']]);
         $this->middleware("permission:force-delete types", ['only' => ['forceDelete']]);
     }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $types = Type::select('types.*');

            return DataTables::of($types)
                ->addColumn('action', function ($types) {
                    return view('pages.admin.types.action', compact('types'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        //
        $types = new Type();
        $types->name = $request->name;
        $types->duration = $request->duration;
        $types->time = $request->time;

        if ($types->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $types, $id)
    {
        $types = Type::find($id);

        return response()->json(['result' => $types]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $types, $id)
    {
        $types = Type::find($id);

        return response()->json(['result' => $types]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $types, $id)
    {
        $types = Type::find($id);

        $types->update([
            'name' => $request->input('name'),
            'duration' => $request->input('duration'),
            'time' => $request->input('time'),
        ]);

        // Simpan perubahan 
        if ($types->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $types, $id)
    {
        $types = Type::find($id);

        if ($types->delete()) {
            return response()->json(['success' => true, 'message' => 'Tipe Cuti berhasil dihapus.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus Tipe Cuti.']);
        }
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $trashedTypes = Type::onlyTrashed();

            return DataTables::of($trashedTypes)
                ->addColumn('action', function ($types) {
                    return view('pages.admin.types.action', compact('types'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.admin.types.trashed');
    }

    public function restore($id)
    {
        $types = Type::onlyTrashed()->find($id);

        if ($types) {
            $types->restore();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function forceDelete($id)
    {
        $types = Type::onlyTrashed()->find($id);

        if ($types) {
            try {
                $types->forceDelete();
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => 'Gagal menghapus Tipe Cuti secara permanen.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Tipe tidak ditemukan atau tidak dalam status terhapus.']);
        }
    }
}
