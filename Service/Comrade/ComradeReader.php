<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service\Comrade;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\VoidCache;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * A wrapper that passes a configured cache service
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service\Comrade
 */
class ComradeReader extends \ComradeReader\Service\ComradeReader
{
    /**
     * Allow constructor to be empty
     * as we are going to inject dependencies via setter methods
     */
    public function __construct()
    {
    }

    /**
     * @param CacheProvider $provider
     */
    public function setCache(CacheProvider $provider)
    {
        $this->cache = $provider;
    }

    /**
     * @param SerializerInterface $serializer
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->secretToken = $token;
    }
}