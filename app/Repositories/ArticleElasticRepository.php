<?php

namespace App\Repositories;

use App\Interfaces\ArticleRepositoryInterface;
use App\Models\Article;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

class ArticleElasticRepository implements ArticleRepositoryInterface
{
    /** @var \Elasticsearch\Client */
    private $elasticsearch;
    protected $article;

    public function __construct(Client $elasticsearch, Article $article)
    {
        $this->article = $article;
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = '')
    {
        $items = $this->searchOnElasticsearch($query);
        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = '')
    {
        if ($query === '') {
            return $this->allOnElasticsearch();
        }

        return $this->elasticsearch->search([
            'index' => $this->article->getSearchIndex(),
            'type' => $this->article->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title^5', 'body'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);
    }

    public function all()
    {
        return $this->buildCollection($this->allOnElasticsearch());
    }

    public function allOnElasticsearch()
    {
        return $this->elasticsearch->search([
            'index' => $this->article->getSearchIndex(),
            'type' => $this->article->getSearchType(),
            'body' => [
                'query' => [
                    'match_all' => (object)[]
                ],
            ],
        ]);
    }

    private function buildCollection(array $items)
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');
        return Article::findMany($ids)
            ->sortBy(function ($article) use ($ids) {
                return array_search($article->getKey(), $ids);
            });
    }

    public function find($id)
    {
        return $this->article->find($id);
    }
}
