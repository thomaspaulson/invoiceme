<?php
declare(strict_types=1);
namespace App\UseCases\Client\ShowClient;

class ShowClientService
{
    private ShowClientRepository $showClientRepo;

    public function __construct(
        ShowClientRepository $repo
    ) {
        $this->showClientRepo = $repo;
    }

    function show(string $id): Client
    {
        $client = $this->showClientRepo->viewClient($id);
        return $client;
    }
}
