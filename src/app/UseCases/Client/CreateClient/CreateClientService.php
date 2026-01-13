<?php
declare(strict_types=1);
namespace App\UseCases\Client\CreateClient;

use Domain\Models\Client\Client;
use Domain\Models\Client\ClientRepository;
use Domain\Shared\Clock;
use Domain\Shared\Date;

class CreateClientService
{
    private ClientRepository $clientRepo;

    private Clock $clock;

    public function __construct(ClientRepository $repo, Clock $clock)
    {
        $this->clientRepo = $repo;
        $this->clock = $clock;
    }

    function create(CreateClient $createClient): string
    {
        $id = $this->clientRepo->uuid();
        $created = $updated = Date::fromCurrentTime($this->clock->currentTime());
        $client = Client::create(
            $id,
            $createClient->company(),
            $createClient->firstName(),
            $createClient->lastName(),
            $createClient->email(),
            $createClient->contact(),
            $createClient->address(),
            $created,
            $updated
        );
        // insert client into db
        $this->clientRepo->create($client);

        return $id;
    }
}
