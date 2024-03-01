<?php

namespace App\Exports;

use App\Models\Leave;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ReportExport implements WithMultipleSheets
{
    use Exportable;

    protected $leaves;
    protected $userId;
    protected $userLevel;

    public function __construct($leaves)
    {
        $this->leaves = $leaves;
        $this->userId = Auth::id();
        $this->userLevel = Auth::user()->position->level;
    }

    public function sheets(): array
    {

        $groupedLeaves = $this->leaves->filter(function ($item) {
            if ($this->userLevel == 1) {
                return true;
            } else {
                return $item->manager_id == $this->userId || $item->coo_id == $this->userId;
            }
        })->groupBy(function ($item) {
            $startDate = Carbon::createFromFormat('Y-m-d', $item->start_date);
            $year = $startDate->format('Y');

            $divisionId = $item->user->division_id;
            return $year . '-' . $divisionId;
        });
        $sheets = [];

        foreach ($groupedLeaves as $key => $leaves) {
            list($year, $divisionId) = explode('-', $key);
            $divisionName = $leaves->first()->user->division->name;

            $sheets[] = new ReportSheetExport($leaves, $year, $divisionName);
        }

        return $sheets;
    }

}


