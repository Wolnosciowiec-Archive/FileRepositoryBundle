<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Service;

use JMS\Serializer\SerializerInterface;
use PaginatorBundle\Repository\PaginatedResults;
use Wolnosciowiec\FileRepositoryBundle\Exception\FileRepositoryRequestFailureException;
use Wolnosciowiec\FileRepositoryBundle\Model\Entity\File;
use Wolnosciowiec\FileRepositoryBundle\Service\Http\Client;

/**
 * Performs checks if file exists, gets statistics
 * and information about file, allows also to delete a file
 * from the remote repository
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
class FileRegistry extends BaseHttpServiceClient
{
    /**
     * @param string $fileName File name or url address
     * @return bool
     */
    public function fileExists($fileName): bool
    {
        try {
            $response = $this->getClient()->post('/repository/image/exists',[
                'file_name' => $fileName,
            ]);

        } catch (FileRepositoryRequestFailureException $e) {
            return false;
        }

        return $response['success'] === true;
    }

    /**
     * @param string $fileName
     * @return string
     */
    public function getFileURL($fileName): string
    {
        $response = $this->getClient()->post('/repository/image/exists', [
            'file_name' => $fileName,
        ]);

        if ($response['success'] === true) {
            return $response['data']['url'];
        }

        return '';
    }

    /**
     * @param string $fileName File name or url address
     * @return bool
     */
    public function deleteFile($fileName): bool
    {
        $response = $this->getClient()->post('/repository/image/delete', [
            'file_name' => $fileName,
        ]);

        return $response['success'] === true;
    }

    /**
     * @param array $tags
     * @param int   $page
     * @param int   $perPage
     * @param string $searchQuery
     *
     * @return PaginatedResults
     */
    public function findBy(array $tags, int $page = 1, int $perPage = 50, string $searchQuery = ''): ?PaginatedResults
    {
        $response = $this->getClient()->postJson('/repository/search/query', json_encode([
            'tags'        => $tags,
            'offset'      => ($perPage * ($page - 1)),
            'limit'       => $perPage,
            'searchQuery' => $searchQuery,
        ]));

        if ($response['success'] === false && !isset($response['results'])) {
            return null;
        }

        return new PaginatedResults(
            $this->createObjects($response['results']),
            $response['pages'],
            $page
        );
    }

    private function createObjects(array $results): array
    {
        return array_map(
            function (array $result) {
                return new File($result);
            },
            $results
        );
    }
}
