<?php

namespace App\Models\e_office;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeRecyclebin extends Model
{
    use HasFactory;


    public function officeFileFlow(){
        return $this->hasOne(OfficeFileUserFlow::class, 'file_id', 'file_id');
    }

    public function officeUser(){
        return $this->hasOne(officeUser::class, 'id', 'user_id');
    }
     
    public function officeDraft(){
        return $this->hasOne(OfficeFileUserFlowDraft::class, 'id', 'draft_id');
    }
}
