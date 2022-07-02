<?php

namespace Swipe\Service;

use Swipe\Class\PaymentLink;

class CoreServiceClass extends BaseService
{
    private static $classes = [
        'paymentLink' => PaymentLink::class,
    ];

    protected function getServiceClass($name)
    {
        return array_key_exists($name, self::$classes) ? self::$classes[$name] : null;
    }
}
