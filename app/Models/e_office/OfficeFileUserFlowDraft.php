<?php

namespace App\Models\e_office;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeFileUserFlowDraft extends Model
{
    use HasFactory;
    public function officeFile()
    {
        // return $this->belongsTo(OfficeFile::class);
        return $this->belongsTo(OfficeFile::class, 'file_id');

    }
    public function officeUser()
    {
        return $this->belongsTo(officeUser::class, 'from_user_id');
    }
}
