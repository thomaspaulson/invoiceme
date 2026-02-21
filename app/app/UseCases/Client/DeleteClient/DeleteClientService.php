<?php
declare(strict_types=1);
namespace App\UseCases\Client\DeleteClient;

use Domain\Models\Client\ClientRepository;

class DeleteClientService
{
    private ClientRepository $clientRepo;

    public function __construct(
        ClientRepository $repo
    ) {
        $this->clientRepo = $repo;
    }

    function delete(string $id): string
    {
        $client = $this->clientRepo->getById($id);
        $this->clientRepo->delete($id);
        return $id;
    }
}
