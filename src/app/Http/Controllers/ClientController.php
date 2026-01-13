<?php

namespace App\Http\Controllers;

use App\UseCases\Client\ShowClient\ShowClientService;
use App\UseCases\Client\CreateClient\CreateClient;
use App\UseCases\Client\CreateClient\CreateClientService;
use App\UseCases\Client\DeleteClient\DeleteClientService;
use App\UseCases\Client\UpdateClient\UpdateClient;
use App\UseCases\Client\UpdateClient\UpdateClientService;
use App\UseCases\Client\ListClients\ListClientService;
use App\UseCases\Client\ListClients\Client;
use Illuminate\Http\Request;
use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;

class ClientController extends Controller
{

    public function index(Request $request, ListClientService $listClientService)
    {

        $clients = $listClientService->list();
        return array_map(
            fn (Client $client) => $client->asArray(),
            $clients
        );

    }

    public function show(Request $request, $id, ShowClientService $showClientService)
    {
        $client = $showClientService->show($id);

        return response()->json($client->asArray());
    }

    public function store(CreateClientRequest $request, CreateClientService $createClientService)
    {

        $createClient = CreateClient::fromRequestData($request->all());
        $clientID = $createClientService->create($createClient);

        return response()->json(['clientID' => $clientID]);
    }

    public function update(UpdateClientRequest $request, $id, UpdateClientService $updateClientService)
    {

        $updateClient = UpdateClient::fromRequestData($request->all());
        $clientID = $updateClientService->update($updateClient, $id);

        return  response()->json(['clientID' => $clientID]);

    }

    public function destroy(Request $request, $id, DeleteClientService $deleteClientService)
    {

        $clientID = $deleteClientService->delete($id);
        return response()->json(['clientID' => $clientID]);
    }

}
