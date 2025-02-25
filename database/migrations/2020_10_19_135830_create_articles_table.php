<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id_article');
            $table->string('name_article');
            $table->string('mot_cle_article');
            $table->string('sommaire_article');
            $table->unsignedBigInteger('id_categorie');
           // $table->foreign('id_categorie')->references('id')->on('b_categories');
            $table->string('image_article');
            $table->longText('description_article');
            $table->unsignedBigInteger('id_admin');
           //$table->foreign('id_admin')->references('id')->on('admins');
            //$table->foreignId('id_admin')->constrained('admins');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
