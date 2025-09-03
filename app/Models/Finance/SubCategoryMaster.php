<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryMaster extends Model
{
    use HasFactory;
    protected $table = 'fi_subcategory_master';

    public function Category(){
        return $this->hasOne('App\Models\Finance\CategoryMaster','id','category_id');
    }

    public function expenses() {
        return $this->hasMany('App\Models\Finance\Expense', 'sub_category', 'id');
    }
   

    
    
}
