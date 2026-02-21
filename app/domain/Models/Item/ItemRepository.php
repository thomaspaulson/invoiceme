<?php

namespace Domain\Models\Item;


interface ItemRepository
{
    function create(Item $item): void;

    function update(Item $item, string $id): void;

    function getById(string $id): Item;

    function delete(string $id): void;

    function uuid(): string;

}
