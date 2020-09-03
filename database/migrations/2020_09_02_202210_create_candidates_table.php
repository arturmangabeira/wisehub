<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string("dsImagem",100)->nullable();
            $table->string("cpf", 11)->nullable();
            $table->string("city", 50)->nullable();
            $table->string("uf",2)->nullable();
            $table->integer("age")->nullable();
            $table->string("dsFormation", 200)->nullable();
            $table->integer('user_id')->unsigned();            
            $table->foreign('user_id')
                    ->unsigned()
                    ->references('id')
                    ->on('users');
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
