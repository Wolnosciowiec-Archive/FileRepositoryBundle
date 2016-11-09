<?php

namespace Wolnosciowiec\FileRepositoryBundle\Model\Repository;

use Doctrine\ORM\EntityRepository;
use Wolnosciowiec\FileRepositoryBundle\Model\Entity\CachedResource;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Model\Repository
 */
class CachedResourceRepository extends EntityRepository
{
    public function persist(CachedResource $resource)
    {
        $this->getEntityManager()->persist($resource);
    }

    public function delete(CachedResource $resource)
    {
        $this->getEntityManager()->detach($resource);
    }

    public function flush(CachedResource $resource = null)
    {
        $this->getEntityManager()->flush($resource);
    }
}