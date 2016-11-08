<?php

namespace Wolnosciowiec\FileRepositoryBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Wolnosciowiec\FileRepositoryBundle\DependencyInjection\Compiler\CacheCompilerPass;

/**
 * @package Wolnosciowiec\FileRepositoryBundle
 */
class FileRepositoryBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CacheCompilerPass(), PassConfig::TYPE_AFTER_REMOVING);
    }
}