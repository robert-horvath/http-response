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
        return new $this->className($this->headers, $this->msgBody);
    }

    public function withReasonPhrase(string $reasonPhrase): ResponseFactoryInterface
    {
        $class = str_replace(' ', '', $reasonPhrase);
        $this->className = $this->fullyQualifiedClassName($class);
        return $this;
    }

    private function fullyQualifiedClassName(string $class): string
    {
        $fullyQualifiedClassName = Response::class . '\\' . $class;
        if (class_exists($fullyQualifiedClassName))
            return $fullyQualifiedClassName;
        throw new \LogicException("Class $fullyQualifiedClassName does not exist.");
    }
}