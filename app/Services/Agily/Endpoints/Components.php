<?php

namespace App\Services\Agily\Endpoints;

class Components extends Endpoint
{
    /**
     * @return \ArrayObject
     */
    public function get()
    {
        return json_decode($this->client->request(
            self::GET,
            'components'
        ), false);
    }
}
