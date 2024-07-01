<?php
// database/factories/TopicFactory.php
namespace Database\Factories;

use App\Models\Topic;
use App\Models\Forum;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        return [
            'forum_id' => Forum::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => 1, 
        ];
    }
}
