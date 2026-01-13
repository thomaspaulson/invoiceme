<?php
declare(strict_types=1);
namespace App\UseCases\Item\UpdateItem;

use Domain\Models\Item\ItemRepository;
use Domain\Shared\Clock;
use Domain\Shared\Date;

class UpdateItemService
{
    private ItemRepository $itemRepo;

    private Clock $clock;

    public function __construct(
        ItemRepository $repo,
        Clock $clock
    ) {
        $this->itemRepo = $repo;
        $this->clock = $clock;
    }

    function update(UpdateItem $updateItem, string $id): string
    {
        $updated = Date::fromCurrentTime($this->clock->currentTime());
        $item = $this->itemRepo->getById($id);
        $item->update(
            $updateItem->name(),
            $updateItem->hsnCode(),
            $updateItem->amount(),
            $updated
        );
        // update item
        $this->itemRepo->update($item, $id);
        return $id;
    }
}
