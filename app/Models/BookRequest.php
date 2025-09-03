<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    use HasFactory;

    public function UserRequestedBook(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function IssueBook(){
        return $this->hasOne('App\Models\Book', 'id', 'book_id');
    }

    public function BookLocation()
    {
        return $this->hasOne('App\Models\BookLocation', 'id', 'book_location_id');
    }
    public function book(){
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function location(){
        return $this->belongsTo(BookLocation::class,'book_location_id','id');
    }
}
