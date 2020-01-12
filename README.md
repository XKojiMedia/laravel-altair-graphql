# Laravel Altair GraphQL

Easily integrate [Altair GraphQL Client](https://altair.sirmuel.design/) into your Laravel projects.

[![GitHub license](https://img.shields.io/github/license/xkojimedia/laravel-altair-graphql.svg)](https://github.com/xkojimedia/laravel-altair-graphql/blob/master/LICENSE)
[![Packagist](https://img.shields.io/packagist/v/xkojimedia/laravel-altair-graphql.svg)](https://packagist.org/packages/xkojimedia/laravel-altair-graphql)
[![Packagist](https://img.shields.io/packagist/dt/xkojimedia/laravel-altair-graphql.svg)](https://packagist.org/packages/xkojimedia/laravel-altair-graphql)
[![StyleCI](https://github.styleci.io/repos/233300751/shield?branch=master)](https://github.styleci.io/repos/233300751)

![altair-graphql](https://i.imgur.com/h63OBPA.png)

> **Please note**: This is not a GraphQL Server implementation, only a UI for testing and exploring your schema. For the server component we recommend [nuwave/lighthouse](https://github.com/nuwave/lighthouse).


**_DISCLAIMER: This is a port of [laravel-graphql-playground](https://github.com/mll-lab/laravel-graphql-playground) from [@mll-lab](https://github.com/mll-lab), but for [Altair GraphQL Client](https://altair.sirmuel.design/)._**

## Installation

    composer require xkojimedia/laravel-altair-graphql

If you are using Laravel < 5.4, add the service provider to your `config/app.php`

```php
'providers' => [
    // Other providers...
    XKojiMedia\AltairGraphQL\AltairGraphQLServiceProvider::class,
]
```

If you are using Lumen, register the service provider in `bootstrap/app.php`

```php
$app->register(XKojiMedia\AltairGraphQL\AltairGraphQLServiceProvider::class);
```

## Configuration

By default, Altair is reachable at `/altair`
and assumes a running GraphQL endpoint at `/graphql`.

To change the defaults, publish the configuration with the following command:

    php artisan vendor:publish --provider="XKojiMedia\AltairGraphQL\AltairGraphQLServiceProvider" --tag=config

You will find the configuration file at `config/altair-graphql.php`.

If you are using Lumen, copy it into that location manually and load the configuration
in your `boostrap/app.php`:

```php
$app->configure('altair-graphql');
```

## Customization

To customize Altair even further, publish the view:

    php artisan vendor:publish --provider="XKojiMedia\AltairGraphQL\AltairGraphQLServiceProvider" --tag=views

You can use that for all kinds of customization.

### Change settings of the Altair instance

Check https://github.com/imolorhe/altair#configuration-options for the allowed config options, for example:

```php
<script>
  var altairOptions = {
    endpointURL: "{{url(config('altair-graphql.endpoint'))}}"
  };

  window.addEventListener("load", function() {
    AltairGraphQL.init(altairOptions);
  });
</script>
```

### Configure session authentication

If you use GraphQL through sessions and CSRF, add the following to the body:

```php
<script>window.__CSRF_TOKEN__ = "{{ csrf_token() }}";</script>
```

Modify the Altair config like so:

```diff
AltairGraphQL.init({
  endpointURL: "{{url(config('altair-graphql.endpoint'))}}",
+ initialPreRequestScript: "altair.helpers.setEnvironment('csrf_token', window.__CSRF_TOKEN__);",
+ initialHeaders: {
+   'X-CSRF-TOKEN': '{{ csrf_token }}'
+ }
})
```

## Local assets

If you want to serve the assets from your own server, you can download them with the command

    php artisan altair-graphql:download-assets

This puts the necessary CSS, JS and Favicon into your `public` directory. If you have
the assets downloaded, they will be used instead of the online version from the CDN.

## Security

If you do not want to enable Altair GraphQL in production, you can disable it in the config file.
The easiest way is to set the environment variable `ALTAIR_GRAPHQL_ENABLED=false`

If you want to add custom middleware to protect the route to Altair GraphQL, you can
add it in the configuration file.
