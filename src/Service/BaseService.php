<?php

namespace Swipe\Service;

abstract class BaseService
{
    private $services;
    private static $swipeClient;

    public function __construct($client)
    {
        self::$swipeClient = $client;
        $this->services = [];
    }

    public function __get($name)
    {
        $serviceClass = $this->getServiceClass($name);

        if ($serviceClass !== null) {

            if (!array_key_exists($name, $this->services)) {
                $this->services[$name] = new $serviceClass(self::$swipeClient);
            }

            return $this->services[$name];
        }

        trigger_error('Undefined property: ' . static::class . '::$' . $name);

        return null;
    }

    abstract protected function getServiceClass($name);
}
