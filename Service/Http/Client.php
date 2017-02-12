<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service\Http;

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
     * @return string
     */
    public function post(string $relativeUrl, array $parameters): string
    {
        return $this->client->request('POST', $this->baseUrl . $relativeUrl, [
            'query' => [
                '_token' => $this->token,
            ],
            'form_params' => $parameters
        ])->getBody()->read(99999);
    }

    /**
     * @param string $relativeUrl
     * @param string $body
     *
     * @return string
     */
    public function postJson(string $relativeUrl, string $body): string
    {
        return $this->client->request('POST', $this->baseUrl . $relativeUrl, [
            'query' => [
                '_token' => $this->token,
            ],
            'body'  => $body,
        ])->getBody()->read(99999);
    }
}
