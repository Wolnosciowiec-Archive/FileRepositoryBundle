<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Model\Entity;

/**
 * @package Wolnosciowiec\FileRepositoryBundle
 */
class File
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var string $contentHash
     */
    private $contentHash;

    /**
     * @var string $mimeType
     */
    private $mimeType;

    /**
     * @var array $tags
     */
    private $tags;

    /**
     * @var \DateTime $dateAdded
     */
    private $dateAdded;

    /**
     * @var string $url
     */
    private $url = '';

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getContentHash(): string
    {
        return $this->contentHash;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return \DateTime
     */
    public function getDateAdded(): \DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $name
     * @return File
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $contentHash
     * @return File
     */
    public function setContentHash(string $contentHash)
    {
        $this->contentHash = $contentHash;
        return $this;
    }

    /**
     * @param string $mimeType
     * @return File
     */
    public function setMimeType(string $mimeType)
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @param array $tags
     * @return File
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @param \DateTime $dateAdded
     * @return File
     */
    public function setDateAdded(\DateTime $dateAdded)
    {
        $this->dateAdded = $dateAdded;
        return $this;
    }

    /**
     * @param string $url
     * @return File
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return bool
     */
    public function isImageType()
    {
        $parts = explode('/', $this->getMimeType());

        return strtolower($parts[0]) == 'image';
    }
}
