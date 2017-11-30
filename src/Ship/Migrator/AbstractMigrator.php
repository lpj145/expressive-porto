<?php
namespace App\Ship\Migrator;

use Illuminate\Database\Capsule\Manager as Capsule;

abstract class AbstractMigrator
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    protected $connectionName = 'default';

    public function __construct(Capsule $capsule)
    {
        $this->schema = $capsule->getConnection($this->connectionName)->getSchemaBuilder();
    }

    abstract public function init();
    abstract public function down();
}
