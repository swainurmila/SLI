<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'contact_no',
        'registration_no',
        'user_name',
        'password',
        'role_id',
        'role',
        'status',
        'state_id',
        'district_id',
        'education',
        'course_name',
        'passing_year',
        'present_address',
        'permanent_address',
        'created_by',
        'is_delete'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function Role() {
        return $this->belongsTo(Role::class, 'role', 'id', 'active');
        //return $this->belongsTo(Role::class, 'role_id', 'id', 'active');
    }


    public function trainingOrders(){
        return $this->hasMany('App\Models\Training\TrTrainingOrder','user_id','id');
    }

    public function enrolledCourses(){
        return $this->hasMany('App\Models\Course\CrCourseCart','user_id','id')->where('enroll_status','completed');
    }


    public static function getPendingCourseUsers()
    {
        return self::where('is_course', '1')
            ->where('role_id', '5')
            ->where('status', '0')
            ->get();
    }

    public static function getRejectCourseUsers()
    {
        return self::where('is_course', '1')
            ->where('role_id', '5')
            ->where('status', '2')
            ->get();
    }
    public function Cr_Attendance(){
        return $this->hasOne('App\Models\Course\CrAttendance', 'student_id', 'id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function sponsor_trainigs(){
        return $this->hasMany('App\Models\Training\TrTrainingOrder','created_by','id');
    }


}
