<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Route configuration
    |--------------------------------------------------------------------------
    |
    | Set the URI at which Altair GraphQL Client can be viewed
    | and any additional configuration for the route.
    |
    */

    'route' => [
        'uri' => '/altair',
        'name' => 'altair-graphql',
        // 'middleware' => ['web']
        // 'prefix' => '',
        // 'domain' => 'graphql.' . env('APP_DOMAIN', 'localhost'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default GraphQL endpoint
    |--------------------------------------------------------------------------
    |
    | The default endpoint that Altair GraphQL is set to.
    | It assumes you are running GraphQL on the same domain
    | as Altair, but can be set to any URL.
    |
    */

    'endpoint' => '/graphql',

    /*
    |--------------------------------------------------------------------------
    | Control Altair availability
    |--------------------------------------------------------------------------
    |
    | Control if Altair is accessible at all.
    | This allows you to disable it in certain environments,
    | for example you might not want it active in production.
    |
    */

    'enabled' => env('ALTAIR_GRAPHQL_ENABLED', true),
];
