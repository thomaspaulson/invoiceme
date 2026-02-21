<?php

namespace Domain\Shared;

interface Clock
{
    public function currentTime(): \DateTimeImmutable;
}
