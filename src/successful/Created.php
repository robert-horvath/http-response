<?php
declare(strict_types = 1);
namespace RHo\Http\Response;

use RHo\Http\Response;

class Created extends Response
{

    public function __construct(array $headers = [], ?string $msgBody = NULL)
    {
        parent::__construct(201, $headers, $msgBody);
        $this->throwExceptionIfMandatoryHeadersMissing();
    }

    private function throwExceptionIfMandatoryHeadersMissing(): void
    {
        $mandatoryHeaders = [
            'Location',
            'ETag',
            'Last-Modified'
        ];
        foreach ($mandatoryHeaders as $header)
            $this->throwExceptionIfMandatoryHeaderMissing($header);
    }
}