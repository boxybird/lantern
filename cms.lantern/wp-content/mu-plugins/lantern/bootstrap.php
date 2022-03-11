<?php

define('LARAVEL_PATH', ABSPATH . '../lantern');

/**
 * Require the Composer autoloader for Lantern.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Require the Composer autoloader for Laravel.
 */
require LARAVEL_PATH . '/vendor/autoload.php';

/**
 * General hook actions.
 */
\BoxyBird\Lantern\Setup::init();

/**
 * Enqueue styles and scripts.
 */
\BoxyBird\Lantern\Enqueue::init();

/**
 * Setup admin pages.
 */
\BoxyBird\Lantern\Menu::init();

/**
 * Start the Lantern by building the Laravel
 * application up to the point of setting the HTTP response.
 *
 * @step-1
 *
 * @next-step in Laravel's /public/index.php
 */
\BoxyBird\Lantern\Run::init();
