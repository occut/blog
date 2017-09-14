<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KaiUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kai_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('username')->default('');
            $table->string('password')->default('');
            $table->string('salt')->default('');
            $table->tinyInteger('ban')->default(1)->unsigned(); // 1=正常 2=禁止
            $table->softDeletes();
            $table->timestamps();
            $table->unique('username');
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
        //
        Schema::dropIfExists('kai_users');
    }
}
