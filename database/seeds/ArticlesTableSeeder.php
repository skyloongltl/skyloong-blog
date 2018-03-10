<?php

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        $images = Storage::files('avatar');

        $category_ids = Category::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $articles = factory(Article::class)
                        ->times(100)
                        ->make()
                        ->each(function ($article, $index)
                        use ($category_ids, $faker, $images)
        {
            $article->section_article = substr($article->body, 0, 200) . '．．．';
            $article->image = Storage::url($faker->randomElement($images));
            $article->category_id = $faker->randomElement($category_ids);
        });

        Article::insert($articles->toArray());
    }
}

