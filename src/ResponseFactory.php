<?php
declare(strict_types = 1);
namespace RHo\Http;

class ResponseFactory implements ResponseFactoryInterface
{

    /** @var array */
    private $headers = [];

    /** @var NULL|string */
    private $msgBody = NULL;

    /** @var string */
    private $className;

    public function withHeaders(array $headers): ResponseFactoryInterface
    {
        $this->headers = $headers;
        return $this;
    }

    function withMsgBody(string $msgBody): ResponseFactoryInterface
    {
        $this->msgBody = $msgBody;
        return $this;
    }

    public function build(): ResponseInterface
    {
        $class = $this->fullyQualifiedClassName();
        return new $class($this->headers, $this->msgBody);
    }

    public function withReasonPhrase(string $reasonPhrase): ResponseFactoryInterface
    {
        $this->className = str_replace(' ', '', $reasonPhrase);
        return $this;
    }

    private function fullyQualifiedClassName(): string
    {
        $fullyQualifiedClassName = Response::class . '\\' . $this->className;
        if (class_exists($fullyQualifiedClassName))
            return $fullyQualifiedClassName;
        throw new \LogicException("Class $fullyQualifiedClassName does not exist.");
    }
}