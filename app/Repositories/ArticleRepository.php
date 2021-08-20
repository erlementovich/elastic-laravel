<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;

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
        return $this->article->find($id);
    }

    public function search(string $query = '')
    {
        return $this->article->search($query)->get();
//        return $this->article
//            ->query()
//            ->where('body', 'like', "%{$query}%")
//            ->orWhere('title', 'like', "%{$query}%")
//            ->get();
    }
}
