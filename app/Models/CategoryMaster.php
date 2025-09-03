<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMaster extends Model
{
    public function books() {
        // return $this->hasMany(Book::class);
        return $this->hasMany(Book::class, 'category_id');
    }
    // use HasFactory;
}
