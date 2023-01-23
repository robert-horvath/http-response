<?php

declare(strict_types=1);

namespace RHo\Http\Response;

interface ResponseInterface
{
    function send(): void;
}
