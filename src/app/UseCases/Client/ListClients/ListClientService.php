<?php
declare(strict_types=1);
namespace App\UseCases\Client\ListClients;

class ListClientService
{
    private ClientListRepository $clients;

    public function __construct(ClientListRepository $repo)
    {
        $this->clients = $repo;
    }

    function list(): array
    {
        return $this->clients->listClients();
    }
}
