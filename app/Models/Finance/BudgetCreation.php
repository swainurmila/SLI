<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetCreation extends Model
{
    use HasFactory;
    protected $table = 'fi_budget_creations';
    public function Category(){
        return $this->hasOne('App\Models\Finance\CategoryMaster','id','category_id');
    }
    public function SubCategory(){
        return $this->hasOne('App\Models\Finance\SubCategoryMaster','id','sub_category_id');
    }
}
