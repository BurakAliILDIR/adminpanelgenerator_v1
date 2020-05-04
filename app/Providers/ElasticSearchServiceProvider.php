<?php

namespace App\Providers;

use App\Traits\ElasticSearch\Elastic;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class ElasticSearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(Elastic::class, function ($app) {
        return new Elastic(
          ClientBuilder::create()
            ->setLogger(ClientBuilder::defaultLogger(storage_path('logs/elastic.log')))
            ->build()
        );
      });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
