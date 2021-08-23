<?php

namespace App\Traits;

use App\Observers\ElasticsearchObserver;

trait Searchable
{
    public static function bootSearchable()
    {
        if (config('services.search.enabled')) {
            static::observe(ElasticsearchObserver::class);
        }
    }

    public function getSearchIndex()
    {
        return $this->getTable();
    }

    public function getSearchType()
    {
        return '_doc';
    }

    public function toSearchArray()
    {
        return [
            'title' => $this->title,
            'body' => $this->body
        ];
    }
}
