<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contients', function (Blueprint $table) {
            $table->foreignId('commande_id')->constrained();
            $table->foreignId('article_id')->constrained();
            $table->integer('Qte');
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
        Schema::dropIfExists('contients');
        Schema::table('contients', function (Blueprint $table) {
            $table->dropForeign('contients_commande_id_foreign');
            $table->dropForeign('contients_article_id_foreign');
        });
    }
}
