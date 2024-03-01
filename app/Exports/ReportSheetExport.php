<?php

namespace App\Exports;

use App\Models\Leave;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ReportSheetExport implements FromView, ShouldAutoSize, WithColumnWidths
{
    protected $leaves;
    protected $year;
    protected $divisionName;
    public function __construct($leaves, $year, $divisionName)
    {
        $this->leaves = $leaves;
        $this->year = $year;
        $this->divisionName = $divisionName;
    }

    public function view(): View
    {

        $months = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];
        $groupedLeaves = $this->leaves->groupBy(function ($item) {
            $startDate = Carbon::createFromFormat('Y-m-d', $item->start_date);
            Carbon::setLocale('id');

            // Format date as month
            return $startDate->translatedFormat('F');
        });

        $groupedLeaves = collect($groupedLeaves)->sortBy(function ($leaves, $month) use ($months) {
            return $months[$month];
        })->all();
        


        return view('pages.report.excel', [
            'groupedLeaves' => $groupedLeaves,
            'year' => $this->year,
            'divisionName' => $this->divisionName,
        ]);
    }

   

    public function columnWidths(): array
    {
        return [
            'A' => '5'
        ];
    }
    public function collection()
    {
        return $this->leaves;
    }
}
