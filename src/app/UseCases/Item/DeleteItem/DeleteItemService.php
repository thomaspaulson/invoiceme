<?php
declare(strict_types=1);
namespace App\UseCases\Item\DeleteItem;

use Domain\Models\Item\ItemRepository;

class DeleteItemService
{
    private ItemRepository $itemRepo;

    public function __construct(
        ItemRepository $repo
    ) {
        $this->itemRepo = $repo;
    }

    function delete(string $id): string
    {
        $item = $this->itemRepo->getById($id);
        $this->itemRepo->delete($id);
        return $id;
    }
}
