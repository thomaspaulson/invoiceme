<?php

namespace Infra\Repo\Item;

use App\UseCases\Item\ListItems\ItemListRepository;
use App\UseCases\Item\ListItems\Item;
use Domain\Shared\Currency;
use Domain\Shared\Date;
use Domain\Shared\Money;
use Illuminate\Support\Facades\DB;

class ItemListDbRepository implements ItemListRepository
{
    public function listItems(): array
    {
        $records = array_map(
            function ($r) {
                return new Item(
                    $r->id,
                    $r->name,
                    $r->hsn_code,
                    new Money($r->rate, new Currency($r->currency)),
                    Date::fromString($r->created_at),
                    Date::fromString($r->updated_at)
                );
            },
            DB::table('items')->get()->toArray()
        );

        return $records;
    }
}
