<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Service;
use Wolnosciowiec\FileRepositoryBundle\Exception\FileRepositoryRequestFailureException;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
class TokenManager extends BaseHttpServiceClient
{
    /**
     * @param array $roles
     * @param array $tags
     *
     * @throws FileRepositoryRequestFailureException
     * @return string
     */
    public function requestTemporaryToken(array $roles, array $tags = [])
    {
        $response = $this->getClient()->postJson('/auth/token/generate', json_encode([
            'roles' => $roles,
            'data'  => [
                'tags' => $tags,
            ]
        ]));

        if (!($response['data']['tokenId'] ?? null)) {
            throw new FileRepositoryRequestFailureException('No token generated, details: ' . json_encode($response));
        }

        return $response['data']['tokenId'];
    }
}
