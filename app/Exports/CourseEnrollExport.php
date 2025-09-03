<?php

namespace App\Exports;

use App\Exports\Concerns\WithBoldHeadings;
use App\Models\Course\CrCourseCart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;

class CourseEnrollExport implements FromCollection , WithHeadings , WithMapping , WithStyles
{

    use WithBoldHeadings;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CrCourseCart::with('course','UserDetails')->where('enroll_status','completed')->orderBy('id','desc')
            ->get();
    }

    public function headings(): array
    {
        return ['User Name','Email','Contact','Course'];
    }

    public function map($row): array
    {
        return [
            $row->UserDetails->first_name . ' ' . $row->UserDetails->last_name,
            $row->UserDetails->email,
            $row->UserDetails->contact_no,
            $row->course->course_name,
        ];
    }
}
