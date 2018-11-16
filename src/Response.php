<?php
declare(strict_types = 1);
namespace RHo\Http;

class Response implements ResponseInterface
{

    /** @var int */
    private $statusCode;

    /** @var array */
    private $headers;

    /** @var NULL|string */
    private $msgBody;

    public function __construct(int $statusCode, array $headers, ?string $msgBody)
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->msgBody = $msgBody;
    }

    public function send(): void
    {
        $this->writeStatusCode();
        $this->writeHeaders();
        $this->writeMsgBody();
    }

    private function writeStatusCode(): void
    {
        http_response_code($this->statusCode);
    }

    private function writeHeaders(): void
    {
        foreach ($this->headers as $header => $value)
            header("$header: $value");
    }

    private function writeMsgBody(): void
    {
        if ($this->msgBody !== NULL)
            echo $this->msgBody;
    }
}