<?php

namespace Infra\Repo\Client;

use App\UseCases\Client\ShowClient\ShowClientRepository;
use App\UseCases\Client\ShowClient\Client;
use Domain\Models\Client\ClientNotFound;
use Illuminate\Support\Facades\DB;
use Domain\Shared\Date;

class ShowClientDbRepository implements ShowClientRepository
{
    public function viewClient(string $id): Client
    {

        $client = DB::table('clients')
        ->where('id', $id)->first();

        if (!$client) {
            throw ClientNotFound::withId($id);
        }

        return new Client(
            $client->id,
            $client->company,
            $client->firstName,
            $client->lastName,
            $client->email,
            $client->contact,
            $client->address,
            Date::fromString($client->created_at),
            Date::fromString($client->updated_at)
        );

    }
}
