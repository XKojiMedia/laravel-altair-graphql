<?php

declare(strict_types=1);

/** @var \Illuminate\Contracts\Config\Repository $config */
$config = app('config');

if ($routeConfig = $config->get('altair-graphql.route')) {
    /** @var \Illuminate\Contracts\Routing\Registrar|\Laravel\Lumen\Routing\Router $router */
    $router = app('router');

    $actions = [
        'as' => $routeConfig['name'] ?? 'altair-graphql',
        'uses' => \XKojiMedia\AltairGraphQL\AltairGraphQLController::class,
    ];

    if (isset($routeConfig['middleware'])) {
        $actions['middleware'] = $routeConfig['middleware'];
    }

    if (isset($routeConfig['prefix'])) {
        $actions['prefix'] = $routeConfig['prefix'];
    }

    if (isset($routeConfig['domain'])) {
        $actions['domain'] = $routeConfig['domain'];
    }

    $router->get(
        $routeConfig['uri'] ?? '/altair',
        $actions
    );
}
