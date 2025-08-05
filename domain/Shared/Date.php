<?php


namespace Domain\Shared;

use DateTimeImmutable;

class Date
{
    private string $date;
    private const DATE_FORMAT = 'Y-m-d H:i:s';

    private function __construct(string $date)
    {
        $this->date = $date;
    }

    public static function fromCurrentTime(
        \DateTimeImmutable $dateTimeImmutable
    ): self {
        return new self(
            $dateTimeImmutable->format(self::DATE_FORMAT)
        );
    }

    public static function fromString(string $date): self {
        $dateTimeImmutable = new \DateTimeImmutable($date);
        return new self(
            $dateTimeImmutable->format(self::DATE_FORMAT)
        );
    }

    public function asString(): string
    {
        return $this->date;
    }
}
