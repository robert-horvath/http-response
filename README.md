[![Build Status](https://travis-ci.org/robert-horvath/http-response.svg?branch=develop)](https://travis-ci.org/robert-horvath/http-response)
[![Code Coverage](https://codecov.io/gh/robert-horvath/http-response/branch/develop/graph/badge.svg)](https://codecov.io/gh/robert-horvath/http-response)
[![Latest Stable Version](https://img.shields.io/packagist/v/robert/http-response.svg)](https://packagist.org/packages/robert/http-response)
# HTTP Response
The HTTP response module is a thin wrapper to send an HTTP response message.
## Example Usage Of HTTP Unauthorized Response Class
The following PHP code
```php
$f = new RHo\Http\ResponseFactory();
$res = $f->withReasonPhrase('Unauthorized')
         ->withHeaders(['Content-Type' => 'application/vnd.api+json;version=1',
                        'WWW-Authenticate' => 'Basic realm="Access to the staging site", charset="UTF-8'])
         ->withMsgBody('{ "apple": "tree" }')
         ->build();
$res->send();
```
would send this HTTP response message
```http
HTTP/1.1 401 Unauthorized
WWW-Authenticate: Basic realm="Access to the staging site", charset="UTF-8
Content-Type: application/prs.api.ela.do+json;version=1
Content-Length: 19

{ "apple": "tree" }
```
Note: Some classes might throw ```LogicException``` exception if a mandatory HTTP response header is missing. For example:
```php
try {
  $res = new RHo\Http\Response\Unauthorized();
} catch (LogicException $e) {
  // "Mandatory 'WWW-Authenticate' header missing."
}
```