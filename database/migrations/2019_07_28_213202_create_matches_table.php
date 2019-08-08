<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->datetime('dateMatch');
            $table->integer('scoreLocal');
            $table->integer('scoreVisitor');
            $table->bigInteger('teamLocal')-> unsigned();
            $table->bigInteger('teamVisitor')-> unsigned();
            $table->bigInteger('usuario_id')-> unsigned();
            $table->bigInteger('state_id')-> unsigned();
        });

        Schema::table('matches',function($table){
            $table->foreign('teamLocal')->references('id')->on('teams');
            $table->foreign('teamVisitor')->references('id')->on('teams');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('state_id')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
