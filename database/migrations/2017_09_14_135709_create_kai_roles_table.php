<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKaiRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kai_roles', function (Blueprint $table) {
            $table->increments('role_id');
            $table->integer('pid')->unsigned();
            $table->string('rolename',20);
            $table->softDeletes();
            $table->timestamps();
            $table->index('rolename');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kai_roles');
    }
}
