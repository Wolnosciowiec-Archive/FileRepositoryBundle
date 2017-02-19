<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Service\Http;

use Psr\Http\Message\ResponseInterface;
use Wolnosciowiec\FileRepositoryBundle\Exception\FileRepositoryRequestFailureException;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Service\Http
 */
class Client
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var string $baseUrl
     */
    private $baseUrl;

    /**
     * @var string $token
     */
    private $token;

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url)
    {
        $this->baseUrl = $url;
        $this->initializeClient(true);

        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Initialize Http Client
     *
     * @param bool $force
     */
    public function initializeClient($force = false)
    {
        if ($this->client instanceof \GuzzleHttp\Client && $force === false) {
            return;
        }

        $this->client = new \GuzzleHttp\Client([
            'base_url' => $this->baseUrl,
        ]);
    }

    /**
     * @param string $relativeUrl
     * @param array $parameters
     *
     * @return array
     */
    public function post(string $relativeUrl, array $parameters): array
    {
        return $this->processBody($this->client->request('POST', $this->baseUrl . $relativeUrl, [
            'query' => [
                '_token' => $this->token,
            ],
            'form_params' => $parameters
        ]));
    }

    /**
     * @param string $relativeUrl
     * @param string $body
     *
     * @return array
     */
    public function postJson(string $relativeUrl, string $body): array
    {
        return $this->processBody($this->client->request('POST', $this->baseUrl . $relativeUrl, [
            'query' => [
                '_token' => $this->token,
            ],
            'headers' => [
                'Cache-Control' => 'no-cache',
            ],
            'json'  => \GuzzleHttp\json_decode($body, true),
        ]));
    }

    /**
     * @param ResponseInterface $response
     * @throws FileRepositoryRequestFailureException
     * @return array
     */
    private function processBody(ResponseInterface $response): array
    {
        $text = $response->getBody()->read(99999);
        $decoded = \GuzzleHttp\json_decode($text, true);

        if (isset($decoded['success']) && !$decoded['success']) {
            throw (new FileRepositoryRequestFailureException('Request failed, response: ' . $text))
                ->setResponse($decoded);
        }

        return $decoded;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
