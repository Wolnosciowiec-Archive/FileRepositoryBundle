<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service;

use Wolnosciowiec\FileRepositoryBundle\Service\Http\Client;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
abstract class BaseHttpServiceClient
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
