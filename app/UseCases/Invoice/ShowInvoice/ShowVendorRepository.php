<?php
declare(strict_types=1);
namespace App\UseCases\Vendor\ShowVendor;

interface ShowVendorRepository
{
    public function viewVendor(string $id): Vendor;
}
