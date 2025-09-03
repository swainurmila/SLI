<?php

namespace App\Models\e_office;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeFile extends Model
{
    use HasFactory;

    public function deliveryMode()
    {
        return $this->belongsTo(OfficeDeliveryMode::class, 'delivery_mode_id');
    }

    public function letterType()
    {
        return $this->belongsTo(OfficeLetterType::class, 'letter_type');
    }
    
    public function section()
    {
        return $this->belongsTo(OfficeSection::class, 'section_id');
    }

    public function department()
    {
        return $this->belongsTo(OfficeDepartment::class, 'department_id');
    }

    public function toUser()
    {
        return $this->belongsTo(officeUser::class, 'to_user_id');
    }

    public function createdUser()
    {
        return $this->belongsTo(officeUser::class, 'created_user_id');
    }

    
    public function mainCategory()
    {
        return $this->belongsTo(OfficeMainCatagory::class, 'main_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(OfficeSubCatagory::class, 'sub_category_id');
    }


    

    
}

