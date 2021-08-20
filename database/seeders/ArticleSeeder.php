<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $articles = Article::factory(100)->create();
        $tags = Tag::factory(40)->create();

        foreach ($articles as $article) {
            $randomTags = $tags->random(rand(2, 6));

            $randomTags->each(function ($tag) use ($article) {
                $article->tags()->save($tag);
            });
        }
    }
}
