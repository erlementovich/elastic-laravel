<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

class ArticleRepository implements ArticleRepositoryInterface
{
    protected $article;

    /**
     * @param Article $article
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function all()
    {
        return $this->article->get();
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function search(string $query = '')
    {
        return $this->article
            ->query()
            ->where('body', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }

}
