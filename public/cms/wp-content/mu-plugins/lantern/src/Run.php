<?php

namespace BoxyBird\Lantern;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Kernel;

class Run
{
    public static function init(): void
    {
        add_action('setup_theme', [Run::class, 'app'], PHP_INT_MAX);
    }

    public static function app(): void
    {
        $app = require_once LARAVEL_PATH . '/bootstrap/app.php';
        $kernel = $app->make(Kernel::class);

        $lantern = Lantern::getInstance();

        $lantern->setApp($app);
        $lantern->setKernel($kernel);
        $lantern->setRequest(Request::capture());
        $lantern->setResponse($kernel->handle($lantern->getRequest()));
    }
}
