<?php declare(strict_types=1);

namespace Wolnosciowiec\FileRepositoryBundle\Service;

/**
 * @package Wolnosciowiec\FileRepositoryBundle
 */
class UserUploadManager extends BaseHttpServiceClient
{
    /**
     * Get a link that could be served to the user
     *
     * @param string $token
     * @param string $backUrl Should contain "|url|" that would be replaced with an uploaded image url
     *
     * @return string
     */
    public function getImageUploadFormUrl(string $token, string $backUrl)
    {
        $backUrl = urlencode($backUrl);
        return $this->getClient()->getBaseUrl() . '/public/upload/image/form?_token=' . $token . '&back_url=' . $backUrl;
    }

    /**
     * @param string $token
     * @param string $backUrl
     *
     * @return string
     */
    public function getFileUploadFormUrl(string $token, string $backUrl)
    {
        $backUrl = urlencode($backUrl);
        return $this->getClient()->getBaseUrl() . '/public/upload/files/form?_token=' . $token . '&back_url=' . $backUrl;
    }
}
