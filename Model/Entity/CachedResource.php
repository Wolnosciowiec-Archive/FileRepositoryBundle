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
     * @param string $id
     * @return $this
     */
    public function setId(string $id)
    {
        $this->id = $id;
        return $this;
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
}