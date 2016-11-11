<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service;

/**
 * Performs checks if file exists, gets statistics
 * and information about file, allows also to delete a file
 * from the remote repository
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
class FileRegistry extends AbstractFileRepositoryService
{
    /**
     * @param string $fileName File name or url address
     * @return bool
     */
    public function fileExists($fileName)
    {
        $response = $this->getComrade()->post('/repository/image/exists', [
            'file_name' => $fileName,
        ]);

        return $response->getResponse()['success'] === true;
    }

    /**
     * @param string $fileName
     * @return string
     */
    public function getFileURL($fileName)
    {
        $response = $this->getComrade()->post('/repository/image/exists', [
            'file_name' => $fileName,
        ])->getResponse();

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
        $response = $this->getComrade()->post('/repository/image/delete', [
            'file_name' => $fileName,
        ]);

        return $response->getResponse()['success'] === true;
    }
}