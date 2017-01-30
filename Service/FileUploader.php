<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service;

use ComradeReader\Collection\Parameters\ParametersBag;
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
        $response = $this->getComrade()->post(
            '/repository/image/add-by-url',
            (new ParametersBag())->set(['file_name' => $url]),
            0
        )->getDecodedResponse();

        if (!in_array($response['code'], [200, 301], true)) {
            throw new UploadFailureException('File upload by url failed, response: "' . json_encode($response) . '"');
        }

        return $response['url'];
    }
}