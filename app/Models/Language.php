<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_name',
        'lang_short_name',
        'lang_flag',
    ];

    public static function getLanguageLists()
    {
        return self::orderBy('id','desc')->get();
    }
}
