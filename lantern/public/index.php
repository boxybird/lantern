<?php

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If The Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is in maintenance / demo mode via the "down" command
| we will load this file so that any pre-rendered content can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

/**
 * Load WordPress. This will include the singleton
 * instance of the Lantern::class started in @step-1.
 *
 * @step-2
 */
require_once __DIR__ . '/../../cms.lantern/wp-load.php';

/**
 * Optionally set up the global WordPress query.
 */
// wp();

/**
 * Run The Application by sending the response.
 *
 * @step-3
 */
$lantern = \BoxyBird\Lantern\Lantern::getInstance();

$lantern->getResponse()->send();
$lantern->getKernel()->terminate($lantern->getRequest(), $lantern->getResponse());
