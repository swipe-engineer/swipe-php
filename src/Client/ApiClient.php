<?php

namespace Swipe\Client;

use Swipe\Client\CurlClient;
use Swipe\Client\SwipeClient;

class ApiClient
{
    private CurlClient $curlClient;
    private SwipeClient $swipeClient;

    public function __construct($swipeClient)
    {
        $this->swipeClient = $swipeClient;
        $this->curlClient  = CurlClient::instance();
    }

    protected function _get($path, $params = [])
    {
        return $this->curlClient
            ->setHeaders([
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $this->swipeClient->getApiKey()
            ])
            ->setUrl($this->swipeClient->getApiUrl() . '/' . $path)
            ->setMethod(CurlClient::METHOD_GET)
            ->setGetParams($params)
            ->execute();
    }

    protected function _post($path, $data = [])
    {
        return $this->curlClient
            ->setHeaders([
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $this->swipeClient->getApiKey()
            ])
            ->setUrl($this->swipeClient->getApiUrl() . '/' . $path)
            ->setMethod(CurlClient::METHOD_POST)
            ->setPostParams($data)
            ->execute();
    }

    protected function _put($path, $data = [])
    {
        return $this->curlClient
            ->setHeaders([
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $this->swipeClient->getApiKey()
            ])
            ->setUrl($this->swipeClient->getApiUrl() . '/' . $path)
            ->setMethod(CurlClient::METHOD_PUT)
            ->setPostParams($data)
            ->execute();
    }

    protected function _delete($path)
    {
        return $this->curlClient
            ->setHeaders([
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $this->swipeClient->getApiKey()
            ])
            ->setUrl($this->swipeClient->getApiUrl() . '/' . $path)
            ->setMethod(CurlClient::METHOD_DELETE)
            ->execute();
    }
}
