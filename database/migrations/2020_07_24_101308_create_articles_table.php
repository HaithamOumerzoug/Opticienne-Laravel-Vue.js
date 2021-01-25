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
            $table->id();
            $table->string('Nom_artc');
            $table->integer('Prix_de_vente');
            $table->integer('Prix_achat');
            $table->foreignId('categorie_id')->constrained();
            $table->foreignId('fournisseur_id')->constrained();
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
        Schema::dropIfExists('articles');
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign('articles_categorie_id_foreign');
            $table->dropForeign('articles_fournisseur_id_foreign');
        });
    }
}
