<?php

namespace App\Exports;

use App\Modal\country;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CsvExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return country::all();
    }
    public function headings(): array
    {
        return [
            '#',
            'Name',
        ];
    }
}
