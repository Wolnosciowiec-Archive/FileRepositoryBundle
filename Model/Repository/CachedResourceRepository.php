<?php

namespace Wolnosciowiec\FileRepositoryBundle\Model\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Wolnosciowiec\FileRepositoryBundle\Model\Entity\CachedResource;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Model\Repository
 */
class CachedResourceRepository extends EntityRepository
{
    /**
     * @param CachedResource $resource
     */
    public function persist(CachedResource $resource)
    {
        $this->getEntityManager()->persist($resource);
    }

    /**
     * @param CachedResource $resource
     */
    public function delete(CachedResource $resource)
    {
        $this->getEntityManager()->detach($resource);
    }

    /**
     * @param CachedResource|null $resource
     */
    public function flush(CachedResource $resource = null)
    {
        $this->getEntityManager()->flush($resource);
    }

    /**
     * @param int $maxDaysCount
     * @return CachedResource[]
     */
    public function findResourcesToVerify($maxDaysCount = 7)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->where('r.active = true');
        $qb->andWhere('DATE_DIFF(CURRENT_DATE(), r.lastChecked) >= :max_days');
        $qb->setParameter('max_days', $maxDaysCount);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param array     $urls
     * @param bool|null $onlyActive
     * @return CachedResource[]
     */
    public function findByUrls(array $urls, $onlyActive = null)
    {
        $qb = $this->createQueryBuilder('r');
        $qb->where('r.url IN (:urls)')
            ->setParameter('urls', $urls);

        if ($onlyActive !== null) {
            $qb->andWhere('r.active = :active')
                ->setParameter('active', $onlyActive);
        }

        return $qb->getQuery()->getResult(Query::HYDRATE_OBJECT);
    }
}