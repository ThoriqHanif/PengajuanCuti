<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\Divisions;
use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index(Request $request)
    {

        $userLevel = auth()->user()->position->level;

        if ($userLevel == 4) {
            return view('pages.error.error-level');
        }
        $divisions = Divisions::all();
        $userLevel = auth()->user()->position->level;
        $userId = auth()->id();

        if ($request->ajax()) {
            $report = Leave::with(['type', 'user', 'user.division', 'manager', 'coo']);


            if ($userLevel == 1) {
                $report = $report->select('leaves.*');
            } elseif ($userLevel == 2) {
                $report = $report->join('users', 'leaves.user_id', '=', 'users.id')
                    ->where('users.id', $userId)
                    ->orWhere('users.manager_id', $userId)
                    ->orWhere('users.coo_id', $userId);
            } elseif ($userLevel == 3) {
                $report = $report->join('users', 'leaves.user_id', '=', 'users.id')
                    ->where('users.id', $userId)
                    ->orWhere('users.manager_id', $userId)
                    ->orWhere('users.coo_id', $userId);
            }

            if ($request->filterStatus) {
                $status = $request->filterStatus;
                if ($status == 'pending') {
                    $report = $report->where('status_coo', 0);
                } else {
                    $report = $report->where('status_coo', $status);
                }
            }

            if ($request->filterTahun) {
                $tahun = $request->filterTahun;
                $report = $report->whereYear('leaves.start_date', $tahun);
            }

            if ($request->filterBulan) {
                $bulan = $request->filterBulan;
                $bulanAngka = $request->filterBulan; // No need to use strtotime
                $report = $report->whereMonth('leaves.start_date', $bulanAngka);
                // dd($bulanAngka);

            }

            if ($request->has('filterDivisi')) {
                $divisionId = $request->filterDivisi;
                if ($divisionId != '') {
                    $report = $report->join('users', 'leaves.user_id', '=', 'users.id')
                        ->where('users.division_id', $divisionId);
                }
            }

            return DataTables::of($report)

                ->addColumn('action', function ($report) {
                    // return view('pages.admin.leaves.action', compact('report'));
                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.report.index', compact('divisions'));
    }

    public function exportExcel()
    {
        $userId = Auth::id();

        $userLevel = auth()->user()->position->level;

        if ($userLevel == 1) {
            $leaves = Leave::all();
        } else {
            $leaves = Leave::where('manager_id', $userId)
                ->orWhere('coo_id', $userId)->get();
            if ($leaves->isEmpty()) {
                return response()->json(['error' => 'Anda tidak memiliki izin untuk mengekspor data.']);
            }
        }
        return Excel::download(new ReportExport($leaves), 'Rekapitulasi Pengajuan.xlsx');

    }
}
