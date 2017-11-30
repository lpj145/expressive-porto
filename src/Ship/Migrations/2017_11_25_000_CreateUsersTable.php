<?php
namespace App\Ship\Migrations;

use App\Ship\Migrator\AbstractMigrator;
use Jenssegers\Mongodb\Schema\Blueprint;

class CreateUsersTable extends AbstractMigrator
{
    public function init()
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->string('name');
            $table->string('username');
            $table->string('password');
            $table->boolean('active');
            $table->rememberToken();
            $table->softDeletes();
            $table->uuid('id');
            $table->unique('username');
            $table->primary('username');
        });
    }

    public function down()
    {
        $this->schema->drop('users');
    }

}
