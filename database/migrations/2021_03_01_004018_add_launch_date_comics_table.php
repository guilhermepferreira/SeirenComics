<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLaunchDateComicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comics', function (Blueprint $table){
            $table->dateTime('launch_date')->default(\Carbon\Carbon::now());
            $table->dropColumn('series');
            $table->dropColumn('category');


            $table->bigInteger('serie_id')->unsigned()->nullable();
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('restrict')->onUpdate('cascade');
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
            $table->dropColumn('launch_date');
            $table->string('series')->nullable();
            $table->string('category')->nullable();
        });
    }
}
