<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPrixDeVenteToContients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contients', function (Blueprint $table) {
            $table->integer('Prix_de_vente')->after('Qte');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contients', function (Blueprint $table) {
            $table->dropColumn('Prix_de_vente');
        });
    }
}
