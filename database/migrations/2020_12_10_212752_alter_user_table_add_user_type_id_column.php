<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTableAddUserTypeIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('dados_usuarios', 'users');

        Schema::table('users', function (Blueprint $table) {
            $table->string('Senha',255)->change();
            $table->dateTime('data_inicio')->change();
            $table->dateTime('data_fim')->change();

            $table->renameColumn('Senha','password');
            $table->renameColumn('Nome','name');
            $table->renameColumn('CPF','cpf');
            $table->renameColumn('ID', 'id');
            $table->renameColumn('data_inicio', 'license_start');
            $table->renameColumn('data_fim', 'license_end');
            $table->renameColumn('data', 'created_at');

            $table->boolean('status')->default(1)->change();
            $table->bigInteger('user_type_id')->after('id')->default(2);
            $table->dateTime('updated_at')->default(\Carbon\Carbon::now());

            $table->dropColumn('codigo');
            $table->dropColumn('tags');
            $table->dropColumn('Login');
            $table->dropColumn('OBS');
            $table->dropColumn('dias_validade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('password', 'Senha');
            $table->renameColumn('name','Nome');
            $table->renameColumn('id', 'ID');
            $table->string('Login');
            $table->dropColumn('user_type_id');
            $table->string('codigo');
            $table->dropColumn('updated_at');
            $table->renameColumn('cpf', 'CPF');
            $table->string('tags');
            $table->string('OBS');
            $table->integer('dias_validade');
            $table->date('license_start')->change();
            $table->date('license_end')->change();
            $table->renameColumn('license_start','data_inicio');
            $table->renameColumn('license_end', 'data_fim');
            $table->renameColumn('created_at', 'data');
        });

        Schema::rename('users', 'dados_usuarios');
    }
}
