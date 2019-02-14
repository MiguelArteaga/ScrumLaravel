<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TaulesScrum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   


        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nom');

        });

        Schema::create('user_team', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('id_team')->unsigned();
            $table->integer('id_user')->unsigned();

            #Constrains

            $table->foreign('id_team')->references('id')->on('teams');
            $table->foreign('id_user')->references('id')->on('users');
            
        });

        Schema::create('projectes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nom');
            $table->text('descripcio');
            $table->integer('product_owner')->unsigned();
            $table->integer('scrum_master')->unsigned();
            $table->integer('team')->unsigned();
            
            #Constrains
            $table->foreign('team')->references('id')->on('teams');
            $table->foreign('product_owner')->references('id')->on('users');
            $table->foreign('scrum_master')->references('id')->on('users');
        });

        Schema::create('sprints', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('data_inici');
            $table->date('data_final');
            $table->integer('projectes')->unsigned();
            #Constrains
            $table->foreign('projectes')->references('id')->on('projectes');
        });

        Schema::create('specs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('descripcio');
            $table->integer('hores')->nullable();
            $table->integer('dificultat')->nullable();
            $table->integer('sprints')->unsigned()->nullable();
            $table->integer('projectes')->unsigned();
            #Constrains
            $table->foreign('sprints')->references('id')->on('sprints');
            $table->foreign('projectes')->references('id')->on('projectes');

        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specs');
        Schema::dropIfExists('sprints');
        Schema::dropIfExists('projectes');
        Schema::dropIfExists('teams');
        Schema::dropIfExists('user_team');
        
        
    }
}
