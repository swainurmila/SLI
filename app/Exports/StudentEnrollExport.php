<?php

namespace App\Exports;

use App\Exports\Concerns\WithBoldHeadings;
use App\Models\Training\TrTrainingOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class StudentEnrollExport implements FromCollection , WithHeadings , WithMapping , WithStyles
{

    use WithBoldHeadings;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TrTrainingOrder::join('tr_training', 'tr_training_orders.training_id', '=', 'tr_training.id')
            ->select('tr_training.name', 'tr_training_orders.payment_type', 'tr_training_orders.training_duration_type', 'tr_training_orders.training_duration','tr_training_orders.selling_price')
            ->get();
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
            $row->selling_price,
        ];
    }
}
