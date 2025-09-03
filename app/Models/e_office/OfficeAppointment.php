<?php

namespace App\Models\e_office;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeAppointment extends Model
{
    use HasFactory;
    
    public function FromUser()
    {
        return $this->belongsTo(officeUser::class, 'user_request_id');
    }

    public function TodUser()
    {
        return $this->belongsTo(officeUser::class, 'to_user_id');
    }
}
