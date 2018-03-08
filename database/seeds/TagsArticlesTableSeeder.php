<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Article;
use App\Models\TagArticle;

class TagsArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag_ids = Tag::all()->pluck('id')->toArray();

        $article_ids = Article::all()->pluck('id')->toArray();

        $faker = app(Faker\Generator::class);

        $tags_articles = factory(TagArticle::class)
                            ->times(100)
                            ->make()
                            ->each(function ($tagArticle, $index)
                                use ($tag_ids, &$article_ids, $faker) {

                                $tagArticle->tag_id = $faker->randomElement($tag_ids);
                                $tagArticle->article_id = current($article_ids);
                                next($article_ids);
                            });

        TagArticle::insert($tags_articles->toArray());
    }
}
