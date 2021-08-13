<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Usuarios
        // $roles = Role::pluck('id');
        // $users = \App\Models\User::factory(20)->create();
        
        // foreach ($users as $key => $user) {
        //     $user->assignRole(Arr::random($roles->toArray()));
        // }

        // \App\Models\Category::factory(4)->create();
        // \App\Models\Post::factory(50)->create();
        // \App\Models\Comment::factory(80)->create();

        // $this->call([
        //     RoleSeeder::class,
        //     LikeSeeder::class
        // ]);
    }
}
