<?php
declare(strict_types=1);
namespace App\UseCases\Item\ListItems;

class ListItemService
{
    private ItemListRepository $items;

    public function __construct(ItemListRepository $repo)
    {
        $this->items = $repo;
    }

    function list(): array
    {
        return $this->items->listItems();
    }
}
