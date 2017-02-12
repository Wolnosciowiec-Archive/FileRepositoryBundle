<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Service;
use Wolnosciowiec\FileRepositoryBundle\Exception\FileRepositoryRequestFailureException;

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
    public function fileExists($fileName)
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
    public function getFileURL($fileName)
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
    public function deleteFile($fileName)
    {
        $response = $this->getClient()->post('/repository/image/delete', [
            'file_name' => $fileName,
        ]);

        return $response['success'] === true;
    }
}
