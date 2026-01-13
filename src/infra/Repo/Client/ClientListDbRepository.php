<?php

namespace Infra\Repo\Client;

use App\UseCases\Client\ListClients\ClientListRepository;
use App\UseCases\Client\ListClients\Client;
use Illuminate\Support\Facades\DB;

class ClientListDbRepository implements ClientListRepository
{
    public function listClients(): array
    {
        $records = array_map(
            function ($r) {
                return new Client(
                    $r->id,
                    $r->company,
                    $r->firstName,
                    $r->lastName,
                    $r->email,
                    $r->contact,
                    $r->address,
                );
            },
            DB::table('clients')->get()->toArray()
        );

        return $records;
    }
}
