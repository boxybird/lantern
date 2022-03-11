<?php

namespace BoxyBird\Lantern;

use Illuminate\Support\Str;

class Setup
{
    public static function init(): void
    {
        add_filter('rest_url', [Setup::class, 'restUrl']);
    }

    /**
     * Fixes WordPress REST API issue when
     * WordPress Address (URL) is not the same as Site Address (URL)
     */
    public static function restUrl($url): string
    {
        return Str::replace(home_url(), site_url(), $url);
    }
}
