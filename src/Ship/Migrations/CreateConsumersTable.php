<?php
namespace App\Ship\Migrations;

use App\Ship\Migrator\AbstractMigrator;
use Jenssegers\Mongodb\Schema\Blueprint;

class CreateConsumersTable extends AbstractMigrator
{
    public function init()
    {
        $this->schema->create('consumers', function (Blueprint $table) {
            $table->string('key');
            $table->string('name');
            $table->string('identifier');
            $table->boolean('active');
            $table->unique('key');
            $table->unique('identifier');
            $table->primary('key');
        });
    }

    public function down()
    {
        $this->schema->drop('consumers');
    }
}
