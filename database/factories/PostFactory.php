<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;

class PostFactory extends Factory
{
    /**
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
        return [
            'name' => $this->faker->title(20),
            'description' => $this->faker->text,
            'description_tinymce' => $this->faker->text,
            'branch_type' => random_int(0, 1),
            'branch_stop_flag' => 0,
            'is_draft_flag' => random_int(0, 1),
            'is_page_flag' => random_int(0, 1),
            'parent_id' => null,
            'user_id' => null,
        ];
    }
}