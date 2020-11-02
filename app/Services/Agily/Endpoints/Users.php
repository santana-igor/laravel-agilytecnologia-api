<?php

namespace App\Services\Agily\Endpoints;

class Users extends Endpoint
{
    /**
     * @return \ArrayObject
     */
    public function get()
    {
        return json_decode($this->client->request(
            self::GET,
            'users'
        ), false);
    }
}
