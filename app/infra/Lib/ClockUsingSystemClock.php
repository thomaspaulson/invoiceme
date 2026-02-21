<?php

namespace Infra\Lib;

use Domain\Shared\Clock;

final class ClockUsingSystemClock implements Clock
{
    public function currentTime(): \DateTimeImmutable
    {
        return new \DateTimeImmutable('now');
    }
}
