<?php
namespace RHo\HttpTest;

use PHPUnit\Framework\TestCase;

final class RedirectionResponseTest extends TestCase
{

    public function testMultipleChoices(): void
    {
        (new \RHo\Http\Response\MultipleChoices())->send();

        $this->assertSame(300, http_response_code());
        $this->expectOutputString('');
    }
}
