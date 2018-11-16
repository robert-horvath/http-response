<?php
namespace RHo\Http;

interface ResponseFactoryInterface
{

    function withReasonPhrase(string $reasonPhrase): ResponseFactoryInterface;

    function withHeaders(array $headers): ResponseFactoryInterface;

    function withBody(string $body): ResponseFactoryInterface;

    function build(): ResponseInterface;
}