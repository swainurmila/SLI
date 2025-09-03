<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'post_title',
        'post_content',
        'post_excerpt'
        
        ];
}
