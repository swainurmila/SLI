<?php

namespace App\Exports;

use App\Models\Training\TrTraining;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\Concerns\WithBoldHeadings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class TrainingListExport implements FromCollection , WithHeadings , WithMapping , WithStyles
{
    use WithBoldHeadings;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return TrTraining::select('name', 'payment_type', 'training_duration_type', 'training_duration','price')
            ->get();


        return TrTraining::all();
    }

    public function headings(): array
    {
        return ['Training Name','Payment Type','Training Duration Type','Training Duration','Price'];
    }

    public function map($row): array
    {
        return [
            $row->name,
            $row->payment_type == 0 ? 'Free' : 'Paid',
            $row->training_duration_type,
            $row->training_duration,
            $row->price,
        ];
    }
}
