<?php
declare(strict_types=1);
namespace App\UseCases\Client\UpdateClient;

use Domain\Models\Client\ClientRepository;
use Domain\Shared\Clock;
use Domain\Shared\Date;

class UpdateClientService
{
    private ClientRepository $clientRepo;

    private Clock $clock;

    public function __construct(
        ClientRepository $repo,
        Clock $clock
    ) {
        $this->clientRepo = $repo;
        $this->clock = $clock;
    }

    function update(UpdateClient $updateClient, string $id): string
    {
        $updated = Date::fromCurrentTime($this->clock->currentTime());
        $client = $this->clientRepo->getById($id);
        $client->update(
            $updateClient->company(),
            $updateClient->firstName(),
            $updateClient->lastName(),
            $updateClient->email(),
            $updateClient->contact(),
            $updateClient->address(),
            $updated
        );
        // update client
        $this->clientRepo->update($client, $id);
        return $id;
    }
}
