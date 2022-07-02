<?php

namespace Swipe\Class;

use Swipe\Client\ApiClient;

class PaymentLink extends ApiClient
{
    const ENDPOINT_NAME = 'payment-links';

    public function __construct($client)
    {
        parent::__construct($client);
    }

    public function index()
    {
        return $this->_get(self::ENDPOINT_NAME);
    }

    public function get($id)
    {
        return $this->_get(self::ENDPOINT_NAME . '/' . $id);
    }

    public function create($data = [])
    {
        return $this->_post(self::ENDPOINT_NAME, $data);
    }

    public function update($id, $data = [])
    {
        return $this->_put(self::ENDPOINT_NAME . '/' . $id, $data);
    }

    public function delete($id)
    {
        return $this->_delete(self::ENDPOINT_NAME . '/' . $id);
    }
}
