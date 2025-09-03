<?php

namespace App\Models\e_office;

use Spatie\Permission\Models\Role as SpatieRole;


class SecondaryRole extends SpatieRole
{
    protected $guard_name = 'officer';
}
