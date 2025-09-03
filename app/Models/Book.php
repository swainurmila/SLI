<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // use HasFactory;
    public function category() {
        return $this->belongsTo(CategoryMaster::class);
    }
    public function images()
    {
        return $this->hasMany(BookImages::class);
    }

    public function image()
    {
        return $this->hasOne(BookImages::class);
    }
    public function bookRequest()
    {
        return $this->hasOne(BookRequest::class);
    }
    public function location(){
        return $this->hasMany(BookLocation::class);
    }
    public function BookImage(){
        return $this->hasOne('App\Models\BookImages','book_id','id');
    }
    public function BookLocation(){
        return $this->hasOne('App\Models\BookLocation','book_id','id');
    }
    public function BookCategory(){
        return $this->hasOne('App\Models\CategoryMaster','id','category_id');
    }
}
