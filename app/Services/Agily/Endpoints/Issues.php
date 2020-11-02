<?php

namespace App\Services\Agily\Endpoints;

class Issues extends Endpoint
{
    /**
     * @return \ArrayObject
     */
    public function get()
    {
        return json_decode($this->client->request(
            self::GET,
            'issues'
        ), false);
    }
}
