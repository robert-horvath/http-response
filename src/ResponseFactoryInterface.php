<?php
namespace RHo\Http;

interface ResponseFactoryInterface
{

    function withReasonPhrase(string $reasonPhrase): ResponseFactoryInterface;

    function withHeaders(array $headers): ResponseFactoryInterface;

    function withMsgBody(string $msgBody): ResponseFactoryInterface;

    function build(): ResponseInterface;
}