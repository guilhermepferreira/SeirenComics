<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComicTraductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comic_traductions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('comic_id')->unsigned();
            $table->string('language');
            $table->string('translated_name');
            $table->timestamps();

            $table->foreign('comic_id')->references('id')->on('comics')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comic_traductions');
    }
}
