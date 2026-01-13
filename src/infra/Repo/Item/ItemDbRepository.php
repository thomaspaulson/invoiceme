<?php

namespace Infra\Repo\Item;

use Domain\Models\Item\Item;
use Domain\Models\Item\ItemNotFound;
use Domain\Models\Item\ItemRepository;
use Domain\Shared\Date;
use Illuminate\Support\Facades\DB;
use Infra\Lib\UuidGenerator;

class ItemDbRepository implements ItemRepository
{
    use UuidGenerator;

    function create(Item $item): void
    {
        try {
            DB::table('items')->insert(
                $item->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function update(Item $item, string $id): void
    {
        try {
            DB::table('items')
            ->where('id', $id)
            ->update(
                $item->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function getById(string $id): Item
    {
        $item = DB::table('items')
        ->where('id', $id)->first();

        if (!$item) {
            throw ItemNotFound::withId($id);
        }

        return Item::fromDatabase(
            $item->id,
            $item->name,
            $item->hsn_code,
            $item->amount,
            Date::fromString($item->created_at),
            Date::fromString($item->updated_at),
        );

    }

    function delete(string $id): void
    {
        try {
            DB::table('items')->delete($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
