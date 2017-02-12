<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service;

use ComradeReader\Collection\Parameters\JsonPayload;
use Wolnosciowiec\FileRepositoryBundle\Exception\UploadFailureException;

/**
 * Takes care of uploading files to the external repository
 * using a REST API
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
class FileUploader extends BaseHttpServiceClient
{
    /**
     * @param string $url
     * @param array  $tags
     *
     * @throws UploadFailureException
     * @return string
     */
    public function uploadFromUrl(string $url, array $tags = [])
    {
        $response = $this->getClient()->postJson('/repository/image/add-by-url', json_encode([
            'fileUrl' => $url,
            'tags'    => $tags,
        ]));

        if (!in_array($response['code'], [200, 301], true)) {
            throw new UploadFailureException('File upload by url failed, response: "' . json_encode($response) . '"');
        }

        return $response['url'];
    }
}
