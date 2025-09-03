<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class TruncateRoles extends Command
{
    protected $signature = 'truncate:roles';

    protected $description = 'Truncate the roles table';

    public function handle()
    {
         // Delete all records in the roles table
    Role::query()->delete();

    $this->info('Roles table deleted successfully.');
    }
}
