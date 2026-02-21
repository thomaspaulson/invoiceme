<?php

namespace Infra\Repo\Item;

use App\UseCases\Item\ShowItem\ShowItemRepository;
use App\UseCases\Item\ShowItem\Item;
use Domain\Models\Item\ItemNotFound;
use Domain\Shared\Currency;
use Illuminate\Support\Facades\DB;
use Domain\Shared\Date;
use Domain\Shared\Money;

class ShowItemDbRepository implements ShowItemRepository
{
    public function viewItem(string $id): Item
    {

        $item = DB::table('items')
        ->where('id', $id)->first();

        if (!$item) {
            throw ItemNotFound::withId($id);
        }

        return new Item(
            $item->id,
            $item->name,
            $item->hsn_code,
            new Money($item->rate,  new Currency($item->currency)),
            Date::fromString($item->created_at),
            Date::fromString($item->updated_at)
        );

    }
}
