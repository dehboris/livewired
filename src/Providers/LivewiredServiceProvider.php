<?php

declare(strict_types=1);

/*
 * This file is part of Livewired.
 *
 * (c) KodeKeep <hello@kodekeep.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KodeKeep\Livewired\Providers;

use Illuminate\Support\ServiceProvider;

class LivewiredServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/livewired.php', 'livewired');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'livewired');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../config/livewired.php' => $this->app->configPath('livewired.php'),
            ], 'config');

            $this->publishes([
                __DIR__.'/../../resources/views' => $this->app->resourcePath('views/vendor/livewired'),
            ], 'views');
        }
    }
}
