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
        Schema::create('factures', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('abonnement_id');
            $table->foreign('abonnement_id')->nullable()->references('id')->on('abonnements');
            $table->date('date')->nullable();
            $table->integer('montant_supplementaire')->default(0);
            $table->date('echeance')->nullable();
            $table->enum('statut',['Payée','En attente','Non payée'])->default('Non payée');
            $table->string('F_OHXACT', 100)->nullable();
            $table->string('F_CUSTCODE', 100)->nullable();
            $table->string('CUSTCODE', 100)->nullable();
            $table->string('DOHA', 100)->nullable();
            $table->string('ND_SUP', 100)->nullable();
            $table->string('LOGIN', 100)->nullable();
            $table->string('REF_FACT', 100)->nullable();
            $table->string('PRODUIT', 100)->nullable();
            $table->string('PL_TAR', 100)->nullable();
            $table->string('DR', 100)->nullable();
            $table->string('F21', 100)->nullable();
            $table->string('F22', 100)->nullable();
            $table->string('F23', 100)->nullable();
            $table->string('intrus', 100)->nullable();
            $table->string('justif', 100)->nullable();
            $table->string('CMOTIF_RS', 100)->default('Actif');
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
        Schema::dropIfExists('factures');
    }
};
