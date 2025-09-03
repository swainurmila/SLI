<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrCategoryMaster extends Model
{
    use HasFactory;
    protected $table = 'cr_category_master';
    protected $fillable = [
        'name',
        'created_by'
    ];

    public function courses(){
        return $this->hasMany('App\Models\Course\CrCourse','course_category_id','id');
    }

    public static function getCategoryLists()
    {
        return self::with('courses')->orderBy('id','desc')->get();
    }
}
