<?php
declare(strict_types = 1);
namespace RHo\Http\Response;

use RHo\Http\Response;

class Unauthorized extends Response
{

    public function __construct(array $headers = [], ?string $msgBody = NULL)
    {
        if (! array_key_exists('WWW-Authenticate', $headers))
            throw new \LogicException("Mandatory 'WWW-Authenticate' header missing.");
        parent::__construct(401, $headers, $msgBody);
    }
}