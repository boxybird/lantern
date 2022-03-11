<?php

define('LARAVEL_PATH', ABSPATH . '../lantern');
define('LANTERN_PLUGIN_URL', plugin_dir_url(__FILE__) . 'lantern');
define('LANTERN_PLUGIN_PATH', plugin_dir_path(__FILE__) . 'lantern');

if (!wp_installing()) {
    require_once __DIR__ . '/lantern/bootstrap.php';
}
