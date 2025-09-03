<?php

namespace App\Models\Research;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpPaperNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_title',
        'start_date',
        'end_date',
    ];
}
