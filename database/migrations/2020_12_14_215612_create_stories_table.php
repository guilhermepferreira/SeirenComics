<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('tb_historias', 'comics');

        Schema::table('comics', function (Blueprint $table) {
            $table->dropColumn('codigo_historia');
            $table->dropColumn('enquete');
            $table->dropColumn('traducao');
            $table->dropColumn('caminho_traducao');
            $table->dropColumn('caminho_capa_historia');
            $table->dropColumn('caminho_miniatura_capa_historia');
            $table->dropColumn('vl_venda');
            $table->dropColumn('idade_exibicao');
            $table->dropColumn('observacao02');
            $table->dropColumn('observacao03');
            $table->dropColumn('dt_alteracao');
            $table->dropColumn('pg_largura');
            $table->dropColumn('pg_altura');

            $table->renameColumn('id_historia', 'id');
            $table->renameColumn('titulo_historia', 'title');
            $table->renameColumn('subtitulo_historia', 'subtitle');
            $table->renameColumn('numero_edicao', 'edition');
            $table->renameColumn('numero_arco', 'arch');
            $table->renameColumn('total_arco', 'total_arch');
            $table->renameColumn('nome_desenhista', 'draftsman');
            $table->renameColumn('nome_colorista', 'colorist');
            $table->renameColumn('categoria', 'category');
            $table->renameColumn('nome_argumentista', 'reviewer');
            $table->renameColumn('caminho_historia', 'path');
            $table->renameColumn('login_alteracao', 'changer');
            $table->renameColumn('ranking', 'rating');
            $table->renameColumn('visualizacoes', 'views');
            $table->renameColumn('observacao01', 'comments');
            $table->integer('pages');
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
        Schema::table('comics', function (Blueprint $table) {
            $table->integer('codigo_historia');
            $table->dateTime('dt_alteracao');
            $table->string('enquete');
            $table->integer('traducao');
            $table->string('caminho_traducao');
            $table->string('caminho_capa_historia');
            $table->string('caminho_miniatura_capa_historia');
            $table->float('vl_venda');
            $table->integer('idade_exibicao');
            $table->string('observacao02');
            $table->string('observacao03');
            $table->string('pg_largura');
            $table->string('pg_altura');

            $table->renameColumn('id', 'id_historia');
            $table->renameColumn('title', 'titulo_historia');
            $table->renameColumn('subtitle', 'subtitulo_historia');
            $table->renameColumn('edition', 'numero_edicao');
            $table->renameColumn('arch', 'numero_arco');
            $table->renameColumn('total_arch', 'total_arco');
            $table->renameColumn('draftsman', 'nome_desenhista');
            $table->renameColumn('colorist', 'nome_colorista');
            $table->renameColumn('category', 'categoria');
            $table->renameColumn('reviewer', 'nome_argumentista');
            $table->renameColumn('path', 'caminho_historia');
            $table->renameColumn('rating', 'ranking');
            $table->renameColumn('views', 'visualizacoes');
            $table->renameColumn('comments', 'observacao01');
            $table->renameColumn('changer', 'login_alteracao');

            $table->dropColumn('pages');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });

        Schema::rename('comics', 'tb_historias');
    }
}
