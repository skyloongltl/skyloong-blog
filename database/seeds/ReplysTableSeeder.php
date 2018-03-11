<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Article;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        $user_ids = User::all()->pluck('id')->toArray();

        $article_ids = Article::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);


        $replys = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply, $index)
            use ($user_ids, $article_ids, $faker) {
            $reply->user_id = $faker->randomElement($user_ids);

            $reply->article_id = $faker->randomElement($article_ids);
        });

        Reply::insert($replys->toArray());
    }

}

