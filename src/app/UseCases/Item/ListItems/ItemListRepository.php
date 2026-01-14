<?php
declare(strict_types=1);
namespace App\UseCases\Item\ListItems;

interface ItemListRepository
{
    public function listItems(): array;
}
