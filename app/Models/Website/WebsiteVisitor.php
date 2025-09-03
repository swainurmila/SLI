<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteVisitor extends Model
{
    protected $fillable = ['count'];

    use HasFactory;


    public static function incrementVisitorCount()
    {
        $visitor = self::first();

        if ($visitor) {
            $visitor->increment('count');
        } else {
            self::create(['count' => 1]);
        }
    }
}
