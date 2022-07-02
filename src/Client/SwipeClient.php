<?php

namespace Swipe\Client;

class SwipeClient
{

    private static $apiKey      = null;
    private static $testMode    = false;

    private static $apiBase     = 'https://f70-backend.test/api';
    private static $apiTestBase = 'https://f70-backend-test.test/api';

    public function __construct($apiKey = null)
    {
        self::$apiKey = $apiKey;
    }

    protected static $instance;

    public static function instance()
    {
        if (static::$instance == null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function getApiUrl()
    {
        return self::$testMode ? self::$apiTestBase : self::$apiBase;
    }

    public static function setApiBase($apiBase)
    {
        self::$apiBase = $apiBase;
    }

    public static function getApiBase()
    {
        return self::$apiBase;
    }

    public static function setApiTestBase($apiTestBase)
    {
        self::$apiTestBase = $apiTestBase;
    }

    public static function getApiTestBase()
    {
        return self::$apiTestBase;
    }

    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    public static function getApiKey()
    {
        return self::$apiKey;
    }

    public static function setTestMode($testMode)
    {
        self::$testMode = $testMode;
    }

    public static function getTestMode()
    {
        return self::$testMode;
    }
}
