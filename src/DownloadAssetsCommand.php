<?php

declare(strict_types=1);

namespace XKojiMedia\AltairGraphQL;

use Illuminate\Console\Command;

class DownloadAssetsCommand extends Command
{
    const BASE_PATH_LOCAL = 'vendor/altair-graphql/';
    const BASE_PATH_CDN = '//cdn.jsdelivr.net/npm/altair-static/build/dist/';

    const RUNTIME_JS_PATH_LOCAL = 'vendor/altair-graphql/runtime.js';
    const RUNTIME_JS_PATH_CDN = '//cdn.jsdelivr.net/npm/altair-static/build/dist/runtime.js';

    const POLYFILLS_JS_PATH_LOCAL = 'vendor/altair-graphql/polyfills.js';
    const POLYFILLS_JS_PATH_CDN = '//cdn.jsdelivr.net/npm/altair-static/build/dist/polyfills.js';

    const MAIN_JS_PATH_LOCAL = 'vendor/altair-graphql/main.js';
    const MAIN_JS_PATH_CDN = '//cdn.jsdelivr.net/npm/altair-static/build/dist/main.js';

    const CSS_PATH_LOCAL = 'vendor/altair-graphql/styles.css';
    const CSS_PATH_CDN = '//cdn.jsdelivr.net/npm/altair-static/build/dist/styles.css';

    const FAVICON_PATH_LOCAL = 'vendor/altair-graphql/favicon.ico';
    const FAVICON_PATH_CDN = '//cdn.jsdelivr.net/npm/altair-static/build/dist/favicon.ico';

    protected $signature = 'altair-graphql:download-assets';

    protected $description = 'Download the newest version of Altair GraphQL assets to serve them locally.';

    public function handle(): void
    {
        $this->fileForceContents(
            self::publicPath(self::CSS_PATH_LOCAL),
            file_get_contents('https:'.self::CSS_PATH_CDN)
        );
        $this->fileForceContents(
            self::publicPath(self::JS_PATH_LOCAL),
            file_get_contents('https:'.self::JS_PATH_CDN)
        );
        $this->fileForceContents(
            self::publicPath(self::FAVICON_PATH_LOCAL),
            file_get_contents('https:'.self::FAVICON_PATH_CDN)
        );
    }

    protected function fileForceContents(string $filePath, string $contents): void
    {
        // Ensure the directory exists
        $directory = dirname($filePath);
        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents(
            $filePath,
            $contents
        );
    }

    public static function basePath(): string
    {
        return self::assetPath(self::BASE_PATH_LOCAL, self::BASE_PATH_CDN);
    }

    public static function cssPath(): string
    {
        return self::assetPath(self::CSS_PATH_LOCAL, self::CSS_PATH_CDN);
    }

    public static function faviconPath(): string
    {
        return self::assetPath(self::FAVICON_PATH_LOCAL, self::FAVICON_PATH_CDN);
    }

    public static function runtimeJsPath(): string
    {
        return self::assetPath(self::RUNTIME_JS_PATH_LOCAL, self::RUNTIME_JS_PATH_CDN);
    }

    public static function polyfillsJsPath(): string
    {
        return self::assetPath(self::POLYFILLS_JS_PATH_LOCAL, self::POLYFILLS_JS_PATH_CDN);
    }

    public static function mainJsPath(): string
    {
        return self::assetPath(self::MAIN_JS_PATH_LOCAL, self::MAIN_JS_PATH_CDN);
    }

    protected static function assetPath(string $local, string $cdn): string
    {
        return file_exists(self::publicPath($local))
            ? self::asset($local)
            : $cdn;
    }

    protected static function asset(string $path): string
    {
        return app('url')->asset($path);
    }

    protected static function publicPath(string $path): string
    {
        return app()->basePath('public/'.$path);
    }
}
