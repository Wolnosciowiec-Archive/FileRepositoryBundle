<?php

namespace Wolnosciowiec\FileRepositoryBundle\Service;

use ComradeReader\Service\ComradeReader;

/**
 * Takes care of uploading files to the external repository
 * using a REST API
 *
 * @package Wolnosciowiec\FileRepositoryBundle\Service
 */
abstract class AbstractFileRepositoryService
{
    /**
     * @var ComradeReader $comrade
     */
    private $comrade;

    /**
     * @param ComradeReader $comrade
     */
    public function __construct(
        ComradeReader $comrade)
    {
        $comrade->setTokenFieldName('_token');
        $this->comrade = $comrade;
    }

    /**
     * @return ComradeReader
     */
    public function getComrade()
    {
        return $this->comrade;
    }
}