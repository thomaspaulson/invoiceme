<?php

namespace App\Domain\Models\Vendor;


interface VendorRepository
{
    function create(Vendor $vendor): void;

    function update(Vendor $user, string $id): void;

    function getById(string $id): Vendor;

    function delete(string $id): void;

    function uuid(): string;

}
