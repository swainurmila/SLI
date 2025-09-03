<?php

namespace App\Models\e_office;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeSubCatagory extends Model
{
    use HasFactory;

    public function mainCategory(){
        return $this->hasOne(OfficeMainCatagory::class, 'id', 'main_catagory_id');
    }
}
