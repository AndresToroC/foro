<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $posts = Post::pluck('id');
        $users = User::pluck('id');

        $title = $this->faker->realText(30);
        $paragraphs = $this->faker->paragraphs(rand(2, 6));
        
        $comment = "<h1>$title</h1>";
        foreach ($paragraphs as $key => $paragraph) {
            $comment .= "<p>$paragraph</p>";
        }

        return [
            'post_id' => $this->faker->randomElement($posts),
            'user_id' => $this->faker->randomElement($users),
            'comment' => $comment
        ];
    }
}
