<?php

namespace Apps\AdisomTest\Providers;

use Illuminate\Support\ServiceProvider;

class RecommendationsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Recommendations\Domain\ChannelRepositoryInterface::class,
            \App\Recommendations\Infrastructure\Eloquent\ChannelRepository::class,
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
