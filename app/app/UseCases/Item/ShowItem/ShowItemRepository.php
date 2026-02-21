<?php
declare(strict_types=1);
namespace App\UseCases\Item\ShowItem;

interface ShowItemRepository
{
    public function viewItem(string $id): Item;
}
