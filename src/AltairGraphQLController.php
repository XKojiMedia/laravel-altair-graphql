<?php

declare(strict_types=1);

namespace XKojiMedia\AltairGraphQL;

class AltairGraphQLController
{
    public function __invoke()
    {
        return view('altair-graphql::index');
    }
}
