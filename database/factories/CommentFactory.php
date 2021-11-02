<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name'=>$this->faker->name(),
            'email'=>$this->faker->email(),
            'body'=>$this->faker->paragraph(),
            'advantages'=>array_rand(['asb','sdf','wer','xcvb'],3),
            'disadvantages'=>array_rand(['asb','sdf','wer','xcvb'],3),
            'rate_participant_number'=>0,
            'rate'=>0
        ];
    }
}
