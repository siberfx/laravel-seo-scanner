<?php

namespace Vormkracht10\Seo\Checks\Performance;

use Illuminate\Http\Client\Response;
use Vormkracht10\Seo\Interfaces\Check;
use Vormkracht10\Seo\Traits\PerformCheck;

class TTFBCheck implements Check
{
    use PerformCheck;

    public string $title = "Check if 'Time To First Byte' is below 600 ms";

    public string $priority = 'high';

    public int $timeToFix = 15;

    public int $scoreWeight = 10;

    public function check(Response $response): bool
    {
        $ttfb = $response->transferStats->getHandlerStats()['starttransfer_time'] ?? 0;

        if ($ttfb <= 0.6) {
            return true;
        }

        return false;
    }
}