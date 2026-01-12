<?php
declare(strict_types=1);
namespace Infra\Lib;

use Domain\Models\Invoice\StoreRepository;

class StoreConfigRepository implements StoreRepository{

    public function get(): array {
        return config()->get('store');
    }
}

