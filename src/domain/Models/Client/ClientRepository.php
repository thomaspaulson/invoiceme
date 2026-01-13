<?php

namespace Domain\Models\Client;


interface ClientRepository
{
    function create(Client $client): void;

    function update(Client $client, string $id): void;

    function getById(string $id): Client;

    function delete(string $id): void;

    function uuid(): string;

}
