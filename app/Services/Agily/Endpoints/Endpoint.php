<?php

namespace App\Services\Agily\Endpoints;

use App\Services\Agily\Client;

abstract class Endpoint
{
    /**
     * @var string
     */
    const GET = 'GET';


    /**
     * @var \App\Services\Agily\Client
     */
    protected $client;

    /**
     * @param \App\Services\Agily\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}
