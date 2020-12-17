<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddAgeVerificationColoumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table){
           $table->boolean('age_verification')->default(1);
           $table->bigInteger('user_type_id')->unsigned()->change();
           $table->boolean('is_active')->default(1);
           $table->string('nickname')->nullable();
           $table->dropColumn('cpf');

           $table->foreign('user_type_id')->on('user_types')->references('id')->onDelete('restrict')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table){
            $table->dropColumn('age_verification');
            $table->dropColumn('is_active');
            $table->string('cpf');
        });
    }
}
