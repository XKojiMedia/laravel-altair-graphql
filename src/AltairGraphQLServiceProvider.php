<?php

declare(strict_types=1);

namespace XKojiMedia\AltairGraphQL;

use Illuminate\Contracts\Config\Repository as ConfigRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AltairGraphQLServiceProvider extends ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/altair-graphql.php';
    const VIEW_PATH = __DIR__.'/../views';

    /**
     * Perform post-registration booting of services.
     *
     * @param  \Illuminate\Contracts\Config\Repository  $config
     *
     * @return void
     */
    public function boot(ConfigRepository $config): void
    {
        $this->loadViewsFrom(self::VIEW_PATH, 'altair-graphql');

        $this->publishes([
            self::CONFIG_PATH => $this->configPath('altair-graphql.php'),
        ], 'config');

        $this->publishes([
            self::VIEW_PATH => $this->resourcePath('views/vendor/altair-graphql'),
        ], 'views');

        if (! $config->get('altair-graphql.enabled', true)) {
            return;
        }

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Load routes from provided path.
     *
     * @param  string  $path
     *
     * @return void
     */
    protected function loadRoutesFrom($path): void
    {
        if (Str::contains($this->app->version(), 'Lumen')) {
            require realpath($path);

            return;
        }

        parent::loadRoutesFrom($path);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(self::CONFIG_PATH, 'altair-graphql');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \XKojiMedia\AltairGraphQL\DownloadAssetsCommand::class,
            ]);
        }
    }

    protected function configPath(string $path): string
    {
        return $this->app->basePath('config/'.$path);
    }

    protected function resourcePath(string $path): string
    {
        return $this->app->basePath('resources/'.$path);
    }
}
