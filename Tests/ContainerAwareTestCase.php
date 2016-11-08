<?php

namespace Wolnosciowiec\FileRepositoryBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a container to test cases
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Tests
 */
abstract class ContainerAwareTestCase extends KernelTestCase
{
    /**
     * @var ContainerInterface $container
     */
    protected $container;

    /**
     * Set up a kernel
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->container = self::$kernel->getContainer();
    }
}