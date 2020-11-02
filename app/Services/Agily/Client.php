<?php

namespace App\Services\Agily;

use App\Services\Agily\Endpoints\Issues;
use App\Services\Agily\Endpoints\Components;
use App\Services\Agily\Endpoints\Timelogs;
use App\Services\Agily\Endpoints\Users;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    /**
     * @var string
     */
    const BASE_URI = 'https://my-json-server.typicode.com/bomoko/algm_assessment/';

    /**
     * @var \Services\Agily\Endpoints\Issues
     */
    private $issues;

    /**
     * @var \Services\Agily\Endpoints\Components
     */
    private $components;

    /**
     * @var \Services\Agily\Endpoints\Timelogs
     */
    private $timelogs;

    /**
     * @var \Services\Agily\Endpoints\Users
     */
    private $users;




    public function __construct()
    {
        $this->http = new HttpClient();

        $this->issues = new Issues($this);
        $this->components = new Components($this);
        $this->timelogs = new Timelogs($this);
        $this->users = new Users($this);
    }

    public function request($method, $uri)
    {
        try {
            $response = $this->http->request(
                $method,
                self::BASE_URI.$uri,
            );

            return $response->getBody()->getContents();
        } catch (GuzzleException $exception) {
            return $exception;
        }
    }

    /**
     * @return \Services\Agily\Endpoints\Issues
     */
    public function issues()
    {
        return $this->issues;
    }

    /**
     * @return \Services\Agily\Endpoints\Components
     */
    public function components()
    {
        return $this->components;
    }

    /**
     * @return \Services\Agily\Endpoints\Timelogs
     */
    public function timelogs()
    {
        return $this->timelogs;
    }

    /**
     * @return \Services\Agily\Endpoints\Users
     */
    public function users()
    {
        return $this->users;
    }
}
