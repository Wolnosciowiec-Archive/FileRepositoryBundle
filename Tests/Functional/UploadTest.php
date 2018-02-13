<?php

namespace Wolnosciowiec\FileRepositoryBundle\Tests\Functional;

use Wolnosciowiec\FileRepositoryBundle\Service\FileRegistry;
use Wolnosciowiec\FileRepositoryBundle\Service\FileUploader;
use Wolnosciowiec\FileRepositoryBundle\Tests\ContainerAwareTestCase;

class UploadTest extends ContainerAwareTestCase
{
    /**
     * Test caching external image
     * by the repository micro service
     *
     * @throws \Wolnosciowiec\FileRepositoryBundle\Exception\UploadFailureException
     */
    public function testUploadByUrl()
    {
        $imageUrl = 'https://avatars0.githubusercontent.com/u/22785395';

        // add a file
        $this->assertNotEmpty($this->container->get(FileUploader::class)
            ->uploadFromUrl($imageUrl));

        $this->assertTrue($this->container->get(FileRegistry::class)
            ->fileExists($imageUrl));

        // delete a file
        $this->container->get(FileRegistry::class)
            ->deleteFile($imageUrl);

        $this->assertFalse($this->container->get(FileRegistry::class)
            ->fileExists($imageUrl));
    }
}