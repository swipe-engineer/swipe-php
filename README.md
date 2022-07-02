# Swipe PHP

It is simple wrapper class written in php to ease use of [Swipe](https://swipego.io) 

## Directory
* [Installation](#installation)
* [Usages](#usages)

## Installation

### Composer
```
composer require swipe/swipe-php
```
Alternatively, you can specify as a dependency in your project's existing composer.json file
```
{
   "require": {
      "swipe/swipe-php": "dev-main",
   }
}
```


## Usages
After installing, you need to require Composer's autoloader and add your code.

Setup config
```$xslt
use Swipe\Swipe;

$swipe = new Swipe(API_KEY);
```

Or leave `Swipe()` blank
```
$swipe = new Swipe();

// SET API KEY
$swipe->setApiKey(API_KEY);

// SET TEST MODE - by default `false`
$swipe->setTestMode(true);

```

## Payment Link

### Create Payment Link
```$xslt
$swipe->paymentLink->create([
    'amount'   => '10',
    'currency' => 'MYR',
    'email'    => 'team@swipego.io',
    'title'    => 'create payment link',
]);
```

### Get Payment Link
```$xslt
$swipe->paymentLink->get(PAYMENT_LINK_ID);
```

### Update Payment Link
```$xslt
$swipe->paymentLink->update([
    'amount'   => '20',
    'currency' => 'MYR',
    'email'    => 'team@swipego.io',
    'title'    => 'create payment link',
]);
```

### Delete Payment Link
```$xslt
$swipe->paymentLink->delete(PAYMENT_LINK_ID);
```

## Source
[Swipe Docs](https://dev-api.swipego.io/docs)


## License
Licensed under the [MIT license](http://opensource.org/licenses/MIT)