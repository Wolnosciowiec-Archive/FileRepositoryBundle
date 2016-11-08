<?php

namespace Wolnosciowiec\FileRepositoryBundle\Tests\Functional;

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
        $this->assertNotEmpty($this->container->get('wolnosciowiec.file_repository.uploader')
            ->uploadFromUrl($imageUrl));

        $this->assertTrue($this->container->get('wolnosciowiec.file_repository.registry')
            ->fileExists($imageUrl));

        // delete a file
        $this->container->get('wolnosciowiec.file_repository.registry')
            ->deleteFile($imageUrl);

        $this->assertFalse($this->container->get('wolnosciowiec.file_repository.registry')
            ->fileExists($imageUrl));
    }
}