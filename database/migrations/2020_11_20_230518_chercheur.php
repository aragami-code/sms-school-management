<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chercheur extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chercheurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username');
            $table->string('nom_famille');
            $table->string('prenom');
            $table->date('date_naiss');
            $table->string('telephone');
            $table->string('age');
            $table->string('type_emploi_sollicite');
            $table->string('type_contrat_sollicite');
            $table->string('distance_minimum');
            $table->string('metier');
            $table->string('description');
            $table->string('genre');
            $table->string('statut_marital');
            $table->integer('pays');
            $table->integer('region');
            $table->integer('ville');
            $table->string('post_code');
            $table->string('adresse');
            $table->string('experience');
            $table->string('niveau_ecole');
            $table->string('resume_cv');
            $table->string('photo');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('chercheurs');
    }
}
