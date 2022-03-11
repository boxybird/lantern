<?php

namespace BoxyBird\Lantern;

class Setup
{
    public static function init(): void
    {
        add_filter('wp_using_themes', '__return_false');

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
}
