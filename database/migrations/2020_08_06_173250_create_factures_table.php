<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->date('date_fact');
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('article_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::table('factures', function (Blueprint $table) {
            $table->dropForeign('factures_patient_id_foreign');
            $table->dropForeign('factures_article_id_foreign');
            $table->dropForeign('factures_user_id_foreign');
        });
    }
}
