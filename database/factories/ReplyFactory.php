<?php
// database/factories/ReplyFactory.php

namespace Database\Factories;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition()
    {
        return [
            'content' => $this->faker->paragraph(),
            'topic_id' => Topic::factory(),
            'user_id' => User::factory(),
        ];
    }
}
