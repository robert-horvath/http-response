<?php
namespace RHo\HttpTest;

use PHPUnit\Framework\TestCase;

final class SuccessFulResponseTest extends TestCase
{

    public function testAccepted(): void
    {
        (new \RHo\Http\Response\Accepted())->send();

        $this->assertSame(202, http_response_code());
        $this->expectOutputString('');
    }

    public function testCreated(): void
    {
        $headers = [
            'Location' => 'http://hello.world',
            'ETag' => 'abc',
            'Last-Modified' => 'now'
        ];
        (new \RHo\Http\Response\Created($headers))->send();

        $this->assertSame(201, http_response_code());
        $this->expectOutputString('');
    }

    public function testCreatedWithoutLocationHeader(): void
    {
        $headers = [
            'ETag' => 'abc',
            'Last-Modified' => 'now'
        ];
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("Mandatory 'Location' header missing.");
        new \RHo\Http\Response\Created($headers, 'abc');
    }

    public function testNoContent(): void
    {
        (new \RHo\Http\Response\NoContent())->send();

        $this->assertSame(204, http_response_code());
        $this->expectOutputString('');
    }

    public function testNoContentWithMsgBody(): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage("The 204 response MUST NOT include a message-body.");
        new \RHo\Http\Response\NoContent([], 'Hi');
    }

    public function testOK(): void
    {
        (new \RHo\Http\Response\OK())->send();

        $this->assertSame(200, http_response_code());
        $this->expectOutputString('');
    }
}
