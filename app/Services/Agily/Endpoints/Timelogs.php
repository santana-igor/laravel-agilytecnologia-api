<?php

namespace App\Services\Agily\Endpoints;

class Timelogs extends Endpoint
{
    /**
     * @return \ArrayObject
     */
    public function get()
    {
        return json_decode($this->client->request(
            self::GET,
            'timelogs'
        ), false);
    }
}
