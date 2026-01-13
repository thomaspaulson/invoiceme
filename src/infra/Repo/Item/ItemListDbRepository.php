<?php

namespace Infra\Repo\Item;

use App\UseCases\Item\ListItems\ItemListRepository;
use App\UseCases\Item\ListItems\Item;
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
                    $r->amount,
                );
            },
            DB::table('items')->get()->toArray()
        );

        return $records;
    }
}
