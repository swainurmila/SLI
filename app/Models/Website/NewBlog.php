<?php

 namespace App\Models\Website;
 use Spatie\Sluggable\HasSlug;
 use Spatie\Sluggable\SlugOptions;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
 use Spatie\Translatable\HasTranslations;

 class NewBlog extends Model
  {

        use HasFactory,HasTranslations,HasSlug;
        protected $table="new_blog";

        public $translatable  = ['title', 'content','excerpt'];

        protected $fillable = [
            'post_id',
            'title',
            'content',
            'excerpt',
            'author',
            'date',
            'status',
            'slug',
            'show_new_icon',
            'custom_link',
            'attachment_img',
            'attachment_file'
        ];
        public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->usingSeparator('-');
    }

    public function setPostTypeTitleAttribute($value)
    {
        $this->attributes['title'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }
    public function setPostTypeContentAttribute($value)
    {
        $this->attributes['content'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }
    public function setPostTypeExcerptAttribute($value)
    {
        $this->attributes['excerpt'] = json_encode($value, JSON_UNESCAPED_UNICODE);

    }

  }


