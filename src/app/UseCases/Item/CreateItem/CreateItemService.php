<?php
declare(strict_types=1);
namespace App\UseCases\Item\CreateItem;

use Domain\Models\Item\Item;
use Domain\Models\Item\ItemRepository;
use Domain\Shared\Clock;
use Domain\Shared\Currency;
use Domain\Shared\Date;

class CreateItemService
{
    private ItemRepository $itemRepo;

    private Clock $clock;

    public function __construct(ItemRepository $repo, Clock $clock)
    {
        $this->itemRepo = $repo;
        $this->clock = $clock;
    }

    function create(CreateItem $createItem): string
    {
        $id = $this->itemRepo->uuid();
        $date = Date::fromCurrentTime($this->clock->currentTime());
        $item = Item::create(
            $id,
            $createItem->name(),
            $createItem->hsnCode(),
            $createItem->amount(),
            $createItem->currency(),
            $date,
            $date
        );
        // insert item into db
        $this->itemRepo->create($item);

        return $id;
    }
}
