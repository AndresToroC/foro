<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'blogger', 'guard_name' => 'web']
        ];

        foreach ($roles as $key => $role) {
            Role::create($role);
        }
    }
}
