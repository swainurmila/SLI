<?php

namespace App\Models\e_office;

use Spatie\Permission\Models\Permission as SpatiePermission;

class SecondaryPermission extends SpatiePermission
{
    protected $guard_name = 'officer';
}
