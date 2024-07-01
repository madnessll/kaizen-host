<?php

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\Models\Topic;
use App\Models\Reply;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Создание 5 пользователей
        $users = User::factory(5)->create();

        // Создание 5 форумов
        for ($i = 1; $i <= 5; $i++) {
            $forum = Forum::create([
                'name' => "Форум №$i",
                'description' => "Описание форума",
            ]);

            // Создание 10 тем в каждом форуме
            for ($j = 1; $j <= 11; $j++) {
                $topic = Topic::create([
                    'forum_id' => $forum->id,
                    'title' => "Тема №$j",
                    'content' => "Описание темы",
                    'user_id' => $users->random()->id,
                ]);

                // Создание 25 комментариев в каждой теме
                for ($k = 1; $k <= 25; $k++) {
                    Reply::create([
                        'topic_id' => $topic->id,
                        'content' => "Комментарий №$k",
                        'user_id' => $users->random()->id,
                    ]);
                }
            }
        }
    }
}
