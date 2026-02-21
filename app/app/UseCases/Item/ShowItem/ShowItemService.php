<?php
declare(strict_types=1);
namespace App\UseCases\Item\ShowItem;

class ShowItemService
{
    private ShowItemRepository $showItemRepo;

    public function __construct(
        ShowItemRepository $repo
    ) {
        $this->showItemRepo = $repo;
    }

    function show(string $id): Item
    {
        $item = $this->showItemRepo->viewItem($id);
        return $item;
    }
}
