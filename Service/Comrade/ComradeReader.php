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
     * @return $this
     */
    public function setCache(CacheProvider $provider)
    {
        $this->cache = $provider;
        return $this;
    }

    /**
     * @param SerializerInterface $serializer
     * @return $this
     */
    public function setSerializer(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->secretToken = $token;
        return $this;
    }
}