<?php

namespace Wolnosciowiec\FileRepositoryBundle\Resources\Migrations;

use Doctrine\DBAL\Schema\Schema;

/**
 * @package Wolnosciowiec\FileRepositoryBundle\Resources\Migrations
 */
class LastChecked_002_Migration
{
    public function up(Schema $schema)
    {
        $table = $schema->getTable('fr_bundle_cached_resource');

        if (!$table->hasColumn('last_checked')) {
            $table->addColumn('last_checked', 'datetime')
                ->setNotnull(false);
        }

        if (!$table->hasColumn('cached_url')) {
            $table->addColumn('cached_url', 'string')
                ->setLength(128)
                ->setNotnull(false);
        }
    }

    public function down(Schema $schema)
    {
        $table = $schema->getTable('fr_bundle_cached_resource');

        if ($table->hasColumn('last_checked')) {
            $table->dropColumn('last_checked');
        }

        if (!$table->hasColumn('cached_url')) {
            $table->dropColumn('cached_url');
        }
    }
}