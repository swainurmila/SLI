<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PageTemplate extends Model
{
    use HasFactory,HasSlug;
    protected $fillable = [
        'temp_name',
        'temp_slug'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('temp_name')
            ->saveSlugsTo('temp_slug')
            ->usingSeparator('_');
    }

    public function posts()
    {
       // return $this->belongsTo(Post::class,'page_template_id','id');
    }

}
