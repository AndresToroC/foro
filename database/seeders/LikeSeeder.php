<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $likes = [
            ['name' => 'like'],
            ['name' => 'dislike'],
            ['name' => 'favorites']
        ];

        foreach ($likes as $key => $like) {
            Like::create($like);
        }
    }
}
