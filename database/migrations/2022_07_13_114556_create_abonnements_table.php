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
        Schema::create('abonnements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_ligne', 25);
            $table->integer('mensualite');
            $table->unsignedInteger('forfait_id');
            $table->foreign('forfait_id')->references('id')->on('forfaits');
            $table->integer('periode_engagement');
            $table->string('produit')->default('Non')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_cloture')->nullable();
            $table->text('commentaire')->nullable();
            $table->string('num_contrat_operateur')->nullable();
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
        Schema::dropIfExists('abonnements');
    }
};
