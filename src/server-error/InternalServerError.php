<?php
declare(strict_types = 1);
namespace RHo\Http\Response;

use RHo\Http\Response;

class InternalServerError extends Response
{

    public function __construct(array $headers = [], ?string $msgBody = NULL)
    {
        parent::__construct(500, $headers, $msgBody);
    }
}