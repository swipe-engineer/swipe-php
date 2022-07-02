<?php

namespace Swipe;

use Swipe\Client\SwipeClient;
use Swipe\Service\CoreServiceClass;

class Swipe
{
    private $coreServiceFactory;

    public function __construct($apiKey = null)
    {
        $this->swipeClient = SwipeClient::instance();
        $this->swipeClient->setApiKey($apiKey);
    }

    public function setApiKey($apiKey)
    {
        $this->swipeClient->setApiKey($apiKey);
    }

    public function setTestMode($testMode)
    {
        $this->swipeClient->setTestMode($testMode);
    }

    public function setApiBase($apiBase)
    {
        $this->swipeClient->setApiBase($apiBase);
    }

    public function setApiTestBase($apiTestBase)
    {
        $this->swipeClient->setApiTestBase($apiTestBase);
    }

    public function __get($name)
    {
        if ($this->swipeClient->getApiKey() == null) {
            throw new \Exception('You must set your API key with Swipe::setApiKey(key).');
        }

        if ($this->coreServiceFactory == null) {
            $this->coreServiceFactory = new CoreServiceClass($this->swipeClient);
        }

        return $this->coreServiceFactory->__get($name);
    }
}
