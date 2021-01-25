<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleastocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articleastocks', function (Blueprint $table) {
            $table->foreignId('stock_id')->constrained();
            $table->foreignId('article_id')->constrained();
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
        Schema::dropIfExists('articleastocks');
        Schema::table('articleastocks', function (Blueprint $table) {
            $table->dropForeign('articleastocks_stock_id_foreign');
            $table->dropForeign('articleastocks_article_id_foreign');
        });
    }
}
