[![Latest Stable Version](https://img.shields.io/packagist/v/robert/http-response.svg?style=flat-square)](https://packagist.org/packages/robert/http-response)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.1-8892BF.svg?style=flat-square)](https://php.net/)

# HTTP Response Interface
This module contains the required interfaces to implement the HTTP response message functionalities.
## Example usage
Builds and sends an HTTP response message.
```php
use RHo\Http\Response\ResponseInterfaceBuilder;

function replyWithBadRequest(ResponseInterfaceBuilder $builder): void {
    $builder->init(StatusCode::BadRequest)
        ->withHeader('Content-Type', 'application/prs.api.ela.do+json;version=1') // optional
        ->withBody('{ "apple": "tree" }')  // optional
        ->build()
        ->send();
}

```
By calling the `replyWithBadRequest` function, it will send the below HTTP response message.
```
HTTP/1.1 400 Bad Request
Content-Type: application/prs.api.ela.do+json;version=1
Content-Length: 19

{ "apple": "tree" }
```
