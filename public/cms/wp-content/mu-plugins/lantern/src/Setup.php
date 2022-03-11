<?php

namespace BoxyBird\Lantern;

class Setup
{
    public static function init(): void
    {
        add_filter('wp_using_themes', '__return_false');
        add_filter('rest_url', [Setup::class, 'restUrl']);

        add_action('init', [Setup::class, 'redirect']);
    }

    /**
     * Redirect to admin page if trying to
     * access the frontend of CMS and not Laravel
     */
    public static function redirect()
    {
        if (site_url() !== request()->url()) {
            return;
        }

        return redirect('/wp-admin')->send();
    }

    /**
     * Fixes WordPress REST API issue when
     * WordPress Address (URL) is not the same as Site Address (URL)
     */
    public static function restUrl($url): string
    {
        if (!is_admin()) {
            return $url;
        }

        $url = str_replace(home_url(), site_url(), $url);

        return $url;
    }
}
