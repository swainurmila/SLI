<?php

namespace App\Models\e_office;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\e_office\officeUser;

class OfficeFileUserFlow extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_deleted', // Add the is_deleted column to the fillable array
        'cc_user_id',
        'is_bin',
    ];


    /**
     * Define a one-to-one relationship with the OfficeFile model.
     */
    public function officeFile()
    {
        // return $this->belongsTo(OfficeFile::class);
        return $this->belongsTo(OfficeFile::class, 'file_id');

    }
    public function officeUser()
    {
        return $this->belongsTo(officeUser::class, 'from_user_id');
    }

    public function priority()
    {
        return $this->belongsTo(OfficePriority::class, 'priority_type');
    }
    
    public function getUsersAttribute()
{
    // Check if cc_user_id is not null
    if ($this->attributes['cc_user_id'] === null) {
        return collect(); // Return an empty collection
    }

    // Retrieve the array of user IDs from the cc_user_id column
    $userIds = json_decode($this->attributes['cc_user_id'], true);

    // Retrieve users based on the array of user IDs
    return officeUser::whereIn('id', $userIds)->get();
}
    public function toUser()
    {
        
        return $this->belongsTo(officeUser::class, 'to_user_id');
    }
    public function ccUsers()
{
    // Check if cc_user_id is not null
    if ($this->cc_user_id === null) {
        return collect(); // Return an empty collection
    }

    // Retrieve the array of user IDs from the cc_user_id column
    $userIds = json_decode($this->cc_user_id, true);

    // Retrieve users based on the array of user IDs
    return officeUser::whereIn('id', $userIds)->get();
}

    
    

}