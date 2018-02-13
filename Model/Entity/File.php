<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Model\Entity;

/**
 * @package Wolnosciowiec\FileRepositoryBundle
 */
class File implements \JsonSerializable
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

    public function __construct(array $data)
    {
        $this->setName($data['name'] ?? '');
        $this->setContentHash($data['content_hash'] ?? '');
        $this->setDateAdded(!empty($data['date_added']) ? new \DateTime($data['date_added']) : new \DateTime());
        $this->setMimeType($data['mime_type'] ?? '');
        $this->setTags($data['tags'] ?? '');
        $this->setUrl($data['url'] ?? '');
    }

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

        return strtolower($parts[0]) === 'image';
    }
    
    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'url'  => $this->getUrl(),
            'tags' => $this->getTags(),
            'dateAdded' => $this->getDateAdded(),
            'contentHash' => $this->getContentHash(),
            'mimeType'    => $this->getMimeType()
        ];
    }
}
