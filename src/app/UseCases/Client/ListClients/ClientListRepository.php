<?php
declare(strict_types=1);
namespace App\UseCases\Client\ListClients;

interface ClientListRepository
{
    public function listClients(): array;
}
