<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
    	return [
    	    'title' => $this->faker->text(35),
            'body' => $this->faker->realText(300),
            'author_id' => Author::factory()
    	];
    }
}
