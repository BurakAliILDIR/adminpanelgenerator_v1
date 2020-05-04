<?php


namespace App\Traits\ModelTraits;


use App\Traits\ElasticSearch\Elastic;

trait ElasticSearchTrait
{
  public function boot()
  {
    $elastic = $this->app->make(Elastic::class);
  
    Post::saved(function ($post) use ($elastic) {
      $elastic->index([
        'index' => 'blog',
        'type' => 'post',
        'id' => $post->id,
        'body' => $post->toArray()
      ]);
    });
  
    Post::deleted(function ($post) use ($elastic) {
      $elastic->delete([
        'index' => 'blog',
        'type' => 'post',
        'id' => $post->id,
      ]);
    });
  }
}
