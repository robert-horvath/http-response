<?php
namespace RHo\HttpTest;

use PHPUnit\Framework\TestCase;

final class ResponseFactoryTest extends TestCase
{

    private $responseFactory;

    protected function setUp()
    {
        $this->responseFactory = new \RHo\Http\ResponseFactory();
    }

    public function testBadRequest(): void
    {
        $this->responseFactory->withHeaders([
            'Content-Type' => 'application/json;charset=UTF-8'
        ])
            ->withMsgBody('test')
            ->withReasonPhrase('Bad Request')
            ->build()
            ->send();
        
        $this->assertSame(400, http_response_code());
        $headers = xdebug_get_headers();
        $this->assertArraySubset([
            'Content-Type: application/json;charset=UTF-8'
        ], $headers);
        $this->expectOutputString('test');
    }

    public function testNotAcceptable(): void
    {
        $this->responseFactory->withReasonPhrase('Not Acceptable')
            ->build()
            ->send();
        
        $this->assertSame(406, http_response_code());
        $this->expectOutputString('');
    }

    public function testUnsupportedMediaType(): void
    {
        $this->responseFactory->withReasonPhrase('Unsupported Media Type')
            ->build()
            ->send();
        
        $this->assertSame(415, http_response_code());
        $this->expectOutputString('');
    }

    public function testMultipleChoices(): void
    {
        $this->responseFactory->withReasonPhrase('Multiple Choices')
            ->build()
            ->send();
        
        $this->assertSame(300, http_response_code());
        $this->expectOutputString('');
    }

    public function testInternalServerError(): void
    {
        $this->responseFactory->withReasonPhrase('Internal Server Error')
            ->build()
            ->send();
        
        $this->assertSame(500, http_response_code());
        $this->expectOutputString('');
    }

    public function testUnauthorized(): void
    {
        $this->responseFactory->withHeaders([
            'Content-Type' => 'application/vnd.api+json;version=1',
            'WWW-Authenticate' => 'Basic realm="Access to the staging site", charset="UTF-8'
        ])
            ->withReasonPhrase('Unauthorized')
            ->build()
            ->send();
        
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
        
        $this->responseFactory->withReasonPhrase('Unauthorized')
            ->build()
            ->send();
    }

    public function testUnknownReasonPhrase(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Class RHo\Http\Response\? does not exist.");
        
        $this->responseFactory->withReasonPhrase('?')
            ->build()
            ->send();
    }
}
