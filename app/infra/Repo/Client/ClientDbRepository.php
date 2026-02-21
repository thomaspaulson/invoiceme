<?php

namespace Infra\Repo\Client;

use Domain\Models\Client\Client;
use Domain\Models\Client\ClientNotFound;
use Domain\Models\Client\ClientRepository;
use Domain\Shared\Date;
use Illuminate\Support\Facades\DB;
use Infra\Lib\UuidGenerator;

class ClientDbRepository implements ClientRepository
{
    use UuidGenerator;

    function create(Client $client): void
    {
        try {
            DB::table('clients')->insert(
                $client->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function update(Client $client, string $id): void
    {
        try {
            DB::table('clients')
            ->where('id', $id)
            ->update(
                $client->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function getById(string $id): Client
    {
        $client = DB::table('clients')
        ->where('id', $id)->first();

        if (!$client) {
            throw ClientNotFound::withId($id);
        }

        return Client::fromDatabase(
            $client->id,
            $client->company,
            $client->firstName,
            $client->lastName,
            $client->email,
            $client->contact,
            $client->address,
            Date::fromString($client->created_at),
            Date::fromString($client->updated_at),
        );

    }

    function delete(string $id): void
    {
        try {
            DB::table('clients')->delete($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
