<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('n_client', 50);
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->unsignedInteger('organisation_id');
            $table->foreign('organisation_id')->references('id')->on('organisations');
            $table->string('derniere_affectation', 100)->nullable();
            $table->string('ville', 50)->nullable();
            $table->string('CIN', 20)->nullable();
            $table->string('dernier_grade', 100)->nullable();
            $table->string('gestionnaire', 100)->nullable();
            $table->string('derniere_province', 100)->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('collaborateurs');
    }
};
