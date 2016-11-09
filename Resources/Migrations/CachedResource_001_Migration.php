<?php

namespace Wolnosciowiec\FileRepositoryBundle\Resources\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Resources\Migrations
 */
class CachedResource_001_Migration
{
    public function up(Schema $schema)
    {
        $table = $schema->createTable('fr_bundle_cached_resource');
        $table->addColumn('id', 'string')
            ->setLength(36)
            ->setNotnull(true);

        $table->addColumn('url', 'string')
            ->setLength(128)
            ->setNotnull(false);

        $table->addColumn('active', 'boolean')
            ->setNotnull(true)
            ->setDefault(false);

        $table->addIndex(['url'], 'cached_resource_url');
        $table->addIndex(['id'], 'cached_resource_id');
        $table->addUniqueIndex(['url'], 'cached_resource_unique');
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('fr_bundle_cached_resource');
    }
}