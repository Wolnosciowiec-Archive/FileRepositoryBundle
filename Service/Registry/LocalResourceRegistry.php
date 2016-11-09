<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service\Manager;

use Doctrine\DBAL\Exception\ForeignKeyConstraintViolationException;
use Wolnosciowiec\FileRepositoryBundle\Model\Entity\CachedResource;
use Wolnosciowiec\FileRepositoryBundle\Model\Repository\CachedResourceRepository;

/**
 * Local resource registry
 * =======================
 *   Allows to store a list of external resources by URL address.
 *   This was created for verifying which external hotlinked images
 *   already expired, so we could stop hotlinking them and switch
 *   to our local version
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service\Manager
 */
class LocalResourceRegistry
{
    /**
     * @var CachedResourceRepository $repository
     */
    protected $repository;

    /**
     * @param CachedResourceRepository $repository
     */
    public function __construct(CachedResourceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $url URL or file name
     * @param bool   $isActive
     *
     * @throws ForeignKeyConstraintViolationException
     * @return CachedResource
     */
    public function addResource($url, $isActive = false)
    {
        $resource = new CachedResource();
        $resource->setUrl($url);
        $resource->setActive($isActive);

        try {
            $this->repository->persist($resource);
            $this->repository->flush($resource);
        }
        catch (ForeignKeyConstraintViolationException $e) {

            if (strpos($e->getMessage(), 'url') !== false) {
                return $this->findResource($url);
            }

            throw $e;
        }

        return $resource;
    }

    /**
     * @param string $url
     * @return null|CachedResource
     */
    public function findResource($url)
    {
        return $this->repository->findOneBy([
            'url' => $url,
        ]);
    }

    /**
     * @param string $url
     */
    public function deleteResource($url)
    {
        $resource = $this->findResource($url);

        if ($resource instanceof LocalResourceRegistry) {
            $this->repository->delete($resource);
            return;
        }
    }

    /**
     * @param string $url
     * @return bool
     */
    public function isResourceActive($url)
    {
        $resource = $this->findResource($url);

        return $resource instanceof CachedResource
            && $resource->isActive();
    }
}