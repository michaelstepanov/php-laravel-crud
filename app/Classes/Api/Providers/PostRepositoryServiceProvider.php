<?php

namespace App\Classes\Api\Providers;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;
use App\Classes\Api\Placeholder\PostRepository;
use App\Classes\Api\Interfaces\PostRepositoryInterface;

class PostRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind([PostRepositoryInterface::class, 'api.posts'], function () {
            return $this->getPostRepository();
        });
    }

    protected function getPostRepository()
    {
        $baseUrl = env('API_PLACEHOLDER_BASE_URL');
        $client = new GuzzleClient(['base_uri' => $baseUrl]);
        return new PostRepository($client);
    }
}