<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;


final class InvoiceId
{
    private string $id;

    private function __construct(string $id) {
        $this->id = $id;
    }

    public static function fromString(string $id): self {
        return new self($id);
    }

    public function __toString(): string {
        return $this->id;
    }
}
