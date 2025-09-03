<?php

namespace App\Models\Appointment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OneDayAppointment extends Model
{
    protected $connection = 'mysql2';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visiting_office',
        'department',
        'designation',
        'officer',
        'purpose',
        'visiting_date',
        'identity_type',
        'identity_number',
        'status',
    ];
}
