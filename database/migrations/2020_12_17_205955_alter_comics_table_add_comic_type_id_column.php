<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterComicsTableAddComicTypeIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comics', function (Blueprint $table){
           $table->bigInteger('comic_type_id')->default(1)->unsigned();
           $table->foreign('comic_type_id')->references('id')->on('comic_types')->onDelete('restrict')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comics', function (Blueprint $table){
            $table->dropForeign('comic_type_id');
            $table->dropColumn('comic_type_id');
        });
    }
}
