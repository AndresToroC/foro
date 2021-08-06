<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = Category::pluck('id');
        $users = User::pluck('id');

        $title = $this->faker->realText(30);
        $paragraphs = $this->faker->paragraphs(rand(4, 10));

        $content = "<h1>$title</h1>";
        foreach ($paragraphs as $key => $paragraph) {
            $content .= "<p>$paragraph</p>";
        }
        
        return [
            'category_id' => $this->faker->randomElement($categories),
            'user_id' => $this->faker->randomElement($users),
            'name' => $this->faker->name,
            'content' => $content,
            'is_visible' => $this->faker->randomElement([1, 0])
        ];
    }
}
