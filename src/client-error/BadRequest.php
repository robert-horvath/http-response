<?php
declare(strict_types = 1);
namespace RHo\Http\Response;

use RHo\Http\Response;

class BadRequest extends Response
{

    public function __construct(array $headers = [], ?string $msgBody = NULL)
    {
        parent::__construct(400, $headers, $msgBody);
    }
}