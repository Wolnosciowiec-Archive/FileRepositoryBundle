<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service;
use Wolnosciowiec\FileRepositoryBundle\Model\Entity\CachedResource;

/**
 * Serializes data to the format
 * that is recognized by wolnosciowiec/remote-resource-verifier
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
class RMVSerializer
{
    /**
     * @param CachedResource[] $cachedResources
     * @param string           $type
     *
     * @return array
     */
    public function serialize(array $cachedResources, string $type = 'Url')
    {
        $results = [];

        foreach ($cachedResources as $index => $cachedResource) {

            if (!$cachedResource instanceof CachedResource) {
                throw new \InvalidArgumentException('Item at index "' . $index . '" is not an instance of "Wolnosciowiec\FileRepositoryBundle\Model\Entity\CachedResource"');
            }

            $results[$index] = [
                'url_address' => $cachedResource->getUrl(),
                'type'        => $type,
            ];
        }

        return $results;
    }
}
