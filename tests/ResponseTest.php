<?php
namespace RHo\HttpTest;

use PHPUnit\Framework\TestCase;

final class ResponseTest extends TestCase
{

    public function testBadRequest(): void
    {
        $headers = [
            'Content-Type' => 'application/json;charset=UTF-8'
        ];
        $body = 'test';
        (new \RHo\Http\Response\BadRequest($headers, $body))->send();
        
        $this->assertSame(400, http_response_code());
        $headers = xdebug_get_headers();
        $this->assertArraySubset([
            'Content-Type: application/json;charset=UTF-8'
        ], $headers);
        $this->expectOutputString('test');
    }

    public function testNotAcceptable(): void
    {
        (new \RHo\Http\Response\NotAcceptable())->send();
        
        $this->assertSame(406, http_response_code());
        $this->expectOutputString('');
    }

    public function testMultipleChoices(): void
    {
        (new \RHo\Http\Response\MultipleChoices())->send();
        
        $this->assertSame(300, http_response_code());
        $this->expectOutputString('');
    }

    public function testUnsupportedMediaType(): void
    {
        (new \RHo\Http\Response\UnsupportedMediaType())->send();
        
        $this->assertSame(415, http_response_code());
        $this->expectOutputString('');
    }

    public function testInternalServerError(): void
    {
        (new \RHo\Http\Response\InternalServerError())->send();
        
        $this->assertSame(500, http_response_code());
        $this->expectOutputString('');
    }

    public function testUnauthorized(): void
    {
        $headers = [
            'Content-Type' => 'application/vnd.api+json;version=1',
            'WWW-Authenticate' => 'Basic realm="Access to the staging site", charset="UTF-8'
        ];
        (new \RHo\Http\Response\Unauthorized($headers))->send();
        
        $this->assertSame(401, http_response_code());
        $headers = xdebug_get_headers();
        $this->assertArraySubset([
            'Content-Type: application/vnd.api+json;version=1',
            'WWW-Authenticate: Basic realm="Access to the staging site", charset="UTF-8'
        ], $headers);
        $this->expectOutputString('');
    }

    public function testUnauthorizedWithoutWWWAuthenticateHeader(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Mandatory 'WWW-Authenticate' header missing.");
        (new \RHo\Http\Response\Unauthorized())->send();
    }
}
