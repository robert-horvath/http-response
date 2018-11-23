<?php
declare(strict_types = 1);
namespace RHo\Http\Response;

use RHo\Http\Response;

class NoContent extends Response
{

    public function __construct(array $headers = [], ?string $msgBody = NULL)
    {
        parent::__construct(204, $headers, $msgBody);
        $this->throwExceptionIfHasContent();
    }

    private function throwExceptionIfHasContent(): void
    {
        if ($this->hasMsgBody())
            throw new \LogicException("The 204 response MUST NOT include a message-body.");
    }
}