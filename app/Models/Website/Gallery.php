<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Gallery extends Model
{
    use HasFactory,HasTranslations;

    public $translatable  = ['title', 'description'];

    protected $fillable = [
        'post_id',
        'title',
        'description',
        'status',
        'gallery_image',

    ];

    public function setGalleryTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function setGalleryDescAttribute($value)
    {
        $this->attributes['description'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }

    public function post()
    {

            return $this->belongsTo(Post::class, 'post_id', 'id');


    }
}
