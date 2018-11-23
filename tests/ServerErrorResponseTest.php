<?php
namespace RHo\HttpTest;

use PHPUnit\Framework\TestCase;

final class ServerErrorResponseTest extends TestCase
{

    public function testInternalServerError(): void
    {
        (new \RHo\Http\Response\InternalServerError())->send();

        $this->assertSame(500, http_response_code());
        $this->expectOutputString('');
    }

    public function testNotImplemented(): void
    {
        (new \RHo\Http\Response\NotImplemented())->send();

        $this->assertSame(501, http_response_code());
        $this->expectOutputString('');
    }
}
