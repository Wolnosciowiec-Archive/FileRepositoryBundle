<?php

namespace Wolnosciowiec\FileRepositoryBundle\Model\Entity;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Model\Entity
 */
class CachedResource
{
    /**
     * @var string $id
     */
    private $id;

    /**
     * URL address that is used to identify
     * the remote resource (eg. image)
     *
     * @var string $url
     */
    private $url;

    /**
     * @var bool $active
     */
    private $active = false;

    /**
     * @var \DateTime $lastChecked
     */
    private $lastChecked;

    /**
     * @var string $cachedUrl
     */
    private $cachedUrl;

    public function __construct()
    {
        $this->lastChecked = new \DateTime('now');
    }

    /**
     * @param string $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCachedUrl()
    {
        return $this->cachedUrl;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     * @return CachedResource
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return CachedResource
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $lastChecked
     * @return CachedResource
     */
    public function setLastChecked($lastChecked)
    {
        $this->lastChecked = $lastChecked;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLastChecked()
    {
        return $this->lastChecked;
    }

    /**
     * @param string $cachedUrl
     * @return CachedResource
     */
    public function setCachedUrl($cachedUrl)
    {
        $this->cachedUrl = $cachedUrl;
        return $this;
    }
}