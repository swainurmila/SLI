<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workshop\Workshop;
use App\Models\Workshop\WsSchedule;
use App\Models\User;
use Auth;

class WsAddToCart extends Model
{
    use HasFactory;
    protected $table = 'ws_add_to_cart';


    public static function getEnrolledCourseLists()
    {
        return self::with('workshop', 'schedule.userAttendance')->where('user_id',Auth::user()->id)->where('enroll_status','completed')->orderBy('id','desc')->get();
    }

    public static function getCheckoutWorkshopLists()
    {
        return self::with('workshop')->where('user_id',Auth::user()->id)->where('enroll_status','pending')->orderBy('id','desc')->get();
    }
    public function workshop() {
        return $this->hasOne(Workshop::class, 'id', 'workshop_id');
    }
    public static function removeEnrolledWorkshop($id)
    {
        return self::find($id)->delete();
    }
    public function transaction(){
        return $this->hasOne(WsTransactionTable::class, 'workshop_id', 'workshop_id');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function schedule(){
        return $this->hasMany(WsSchedule::class, 'workshop_id', 'workshop_id');
    }
}
