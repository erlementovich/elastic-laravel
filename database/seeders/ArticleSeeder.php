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
        $tags = collect();
        foreach ($this->getTags() as $tag) {
            $tags->push(Tag::factory()->create(['name' => $tag]));
        }

        foreach ($articles as $article) {
            $randomTags = $tags->random(rand(2, 6));

            $randomTags->each(function ($tag) use ($article) {
                $article->tags()->save($tag);
            });
        }
    }

    public function getTags()
    {
        return [
            'Ягода',
            'Природа',
            'Погода',
            'Азбука',
            'Жизнь',
            'Деньги',
            'Работа',
            'Учеба',
            'Образование',
            'Скандал',
            'Машина',
            'Книги',
            'Самолеты',
            'Фрукты',
            'Здоровое питание',
            'Информатика',
            'География',
            'Физика',
            'Последовательности',
            'Иерархия',
            'Крик',
            'Посольство',
            'Генератор массивов',
            'Интернатура',
            'Аспирантура',
            'Квадратура круга'
        ];
    }
}
