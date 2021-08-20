<?php

namespace App\Providers;

use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\AuthorRepositoryInterface;
use App\Models\Article;
use App\Repositories\ArticleElasticRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->bindSearchClient();

        $this->app->bind(ArticleRepositoryInterface::class, function () {
            if (!config('services.search.enabled')) {
                return App::make(ArticleRepository::class);
            }
            return App::make(ArticleElasticRepository::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('services.search.hosts'))
                ->build();
        });
    }
}
