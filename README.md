# Network

[![Packagist](https://img.shields.io/packagist/dt/vAlmaraz/php-network.svg)](https://packagist.org/packages/valmaraz/php-network) [![Packagist](https://img.shields.io/packagist/v/vAlmaraz/php-network.svg)](https://packagist.org/packages/valmaraz/php-network) [![Packagist](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://packagist.org/packages/valmaraz/php-network)

Network is a lightweight library to send http requests.

## Installation

```
composer require vAlmaraz/php-network
```

## Usage

```php
use vAlmaraz\network\Network;

// Set URL and execute request
$response = Network::get($url)->execute();

// Retrieve response
echo $response->getBody();
```

## Advanced Usage

```php
use vAlmaraz\network\Network;

$timeoutInSeconds = 3;
$headers = ['Accept' => 'application/json'];
$formData = ['field1' => 'value1', 'field2' => 'value2'];

// Configure request
$response = Network::post($url)
    ->setTimeoutInSeconds($timeoutInSeconds)
    ->withHeaders($headers)
    ->withFormData($formData)
    ->execute();

// Retrieve response info
echo $response->getStatusCode();
echo json_encode($response->getHeaders());
echo $response->getBody();
```

## Examples

```php
use vAlmaraz\network\Network;

$network = new Network();
// GET
$response = $network->get('https://jsonplaceholder.typicode.com/posts')
    ->execute();
// POST
$response = $network->post('https://jsonplaceholder.typicode.com/posts')
    ->withFormData(['title' => 'My title', 'body' => 'The body', 'userId' => 123])
    ->execute();
// PATCH
$response = $network->patch('https://jsonplaceholder.typicode.com/posts/1')
    ->withFormData(['title' => 'A new title'])
    ->execute();
// PUT
$response = $network->put('https://jsonplaceholder.typicode.com/posts/1')
    ->withFormData(['title' => 'My title', 'body' => 'The body', 'userId' => 123])
    ->execute();
// DELETE
$response = $network->delete('https://jsonplaceholder.typicode.com/posts/1')
    ->execute();

echo 'Status code: ' . $response->getStatusCode() . PHP_EOL . PHP_EOL;
echo 'Headers: ' . json_encode($response->getHeaders()) . PHP_EOL . PHP_EOL;
echo 'Body: ' . $response->getBody();
```

## License

This project is licensed under the MIT license. Please see the LICENSE file for more information.
