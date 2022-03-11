<?php

namespace BoxyBird\Lantern;

class Enqueue
{
    public static function init(): void
    {
        add_action('admin_enqueue_scripts', [Enqueue::class, 'enqueue']);
    }

    public static function enqueue(): void
    {
        wp_enqueue_style('lantern-admin', LANTERN_PLUGIN_URL . '/assets/css/lantern-admin.css');
    }
}
