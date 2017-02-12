<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Exception;

class FileRepositoryRequestFailureException extends \Exception
{
    /**
     * @var array|string $response
     */
    private $response;

    /**
     * @param array|string $response
     * @return FileRepositoryRequestFailureException
     */
    public function setResponse($response)
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return array|string
     */
    public function getResponse()
    {
        return $this->response;
    }
}
