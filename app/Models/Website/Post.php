<?php

namespace App\Models\Website;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasFactory,HasTranslations,HasSlug;

    public $translatable  = ['post_title', 'post_content', 'post_excerpt'];

    protected $fillable = [
        'post_title',
        'post_content',
        'post_excerpt',
        'post_author',
        'post_date',
        'post_status',
        'post_type',
        'post_template',
        'post_slug',
        'post_attachment'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('post_title')
            ->saveSlugsTo('post_slug')
            ->usingSeparator('-');
    }

    public function getAttributeTranslation($value)
    {
        return $value;
        return json_decode($value, true);
    }

    public function setPostTitleAttribute($value)
    {
        $this->attributes['post_title'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function setPostContentAttribute($value)
    {
        $this->attributes['post_content'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }
    public function setPostExcerptAttribute($value)
    {
        $this->attributes['post_excerpt'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }

    public function pageTemplate()
    {
        //return $this->hasOne(PageTemplate::class,'page_template_id','id');
       return $this->belongsTo(PageTemplate::class,'page_template_id','id');
       //return $this->belongsTo(ab_sponsor::class, 'sponsor_name', 'id');
       //return 1;
    }
    public function slider()
    {
       // return $this->belongsTo(Slider::class,'post_id','id');
        return $this->hasMany(Slider::class,'post_id','id');
    }

    public function gallery()
    {
       // return $this->belongsTo(Slider::class,'post_id','id');
        return $this->hasMany(Gallery::class,'post_id','id');
    }


    // public function slider()
    // {
    //     return
    // }


}
