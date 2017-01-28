# Network

Network is a lightweight library for performing http requests.

## Usage

```php
use network\Network;

// Set URL and execute request
$response = Network::get($url)->execute();

// Retrieve response
echo $response->getBody();
```

## Advanced Usage

```php
use network\Network;

// Configure request
$response = Network::post($url)
    ->withHeaders($headers)
    ->withFormData($formData)
    ->execute();

// Retrieve response info
echo $response->getStatusCode();
echo json_encode($response->getHeaders());
echo $response->getBody();
```

## License

This project is licensed under the MIT license. Please see the LICENSE file for more information.
