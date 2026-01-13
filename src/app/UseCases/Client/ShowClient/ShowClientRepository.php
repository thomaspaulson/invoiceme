<?php
declare(strict_types=1);
namespace App\UseCases\Client\ShowClient;

interface ShowClientRepository
{
    public function viewClient(string $id): Client;
}
