<?php
declare(strict_types=1);
namespace Infra\Lib;

use Domain\Models\Invoice\TaxRepository;

class TaxConfigRepository implements TaxRepository{

    public function get(): array {
        return config()->get('tax');
    }
}

