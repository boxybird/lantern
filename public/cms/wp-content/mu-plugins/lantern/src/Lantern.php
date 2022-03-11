<?php

namespace BoxyBird\Lantern;

use Illuminate\Http\Request;
use Illuminate\Container\Container;
use Illuminate\Foundation\Http\Kernel;

class Lantern
{
    protected $app;

    protected $kernel;

    protected $request;

    protected $response;

    protected static $instance;

    public function setApp(Container $app): void
    {
        $this->app = $app;
    }

    public function getApp(): Container
    {
        return $this->app;
    }

    public function setKernel(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function getKernel(): Kernel
    {
        return $this->kernel;
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setResponse($response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
