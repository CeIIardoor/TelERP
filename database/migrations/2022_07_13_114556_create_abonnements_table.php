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
            $table->unsignedInteger('collaborateur_id');
            $table->foreign('collaborateur_id')->references('id')->on('collaborateurs');
            $table->string('numero_ligne', 25);
            $table->integer('mensualite');
            $table->unsignedInteger('forfait_id');
            $table->foreign('forfait_id')->references('id')->on('forfaits');
            $table->integer('periode_engagement');
            $table->enum('telephone',['Oui','Non'])->default('Non')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_cloture')->nullable();
            $table->text('commentaire')->nullable();
            $table->string('num_contrat_operateur')->nullable();
            $table->date('deleted_at')->default(Null);
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
