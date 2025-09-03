<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = 'fi_expenses';

    public function Category(){
        return $this->hasOne('App\Models\Finance\CategoryMaster','id','category');
    }
    public function SubCategory(){
        return $this->hasOne('App\Models\Finance\SubCategoryMaster','id','sub_category');
    }

    public function BankDetails(){
        return $this->hasOne('App\Models\Finance\BankDetails','id','pay_form');
    }
}
