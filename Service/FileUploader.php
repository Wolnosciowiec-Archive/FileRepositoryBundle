<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service;

use ComradeReader\Service\ComradeReader;
use Wolnosciowiec\FileRepositoryBundle\Exception\UploadFailureException;

/**
 * Takes care of uploading files to the external repository
 * using a REST API
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
class FileUploader extends AbstractFileRepositoryService
{
    /**
     * @param string $url
     * @throws UploadFailureException
     * @return string
     */
    public function uploadFromUrl($url)
    {
        $response = $this->getComrade()->post('/repository/image/add-by-url', [
            'file_name' => $url,
        ], 0)->getResponse();

        if ($response['code'] !== 200) {
            throw new UploadFailureException('File upload by url failed with message: "' . $response['message']);
        }

        return $response['url'];
    }
}