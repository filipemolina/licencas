<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CamposFinaisTabelaEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            
            $table->string('nome_fantasia')->after('razao_social');
            $table->string('inscricao_estadual')->after('nome_fantasia');
            $table->string('fax')->after('telefone');
            $table->string('celular')->after('fax');
            $table->integer('endereco_requerente_id')->after('email');
            $table->integer('endereco_empreendimento_id')->after('email');
            $table->integer('endereco_correspondencia_id')->after('email');
            $table->integer('representante_1_id')->after('endereco_correspondencia_id');
            $table->integer('representante_2_id')->after('representante_1_id');
            $table->integer('contato_id')->after('representante_2_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            
            $table->dropColumn('nome_fantasia');
            $table->dropColumn('inscricao_estadual');
            $table->dropColumn('fax');
            $table->dropColumn('celular');
            $table->dropColumn('endereco_requerente_id');
            $table->dropColumn('endereco_empreendimento_id');
            $table->dropColumn('endereco_correspondencia_id');
            $table->dropColumn('representante_1_id');
            $table->dropColumn('representante_2_id');
            $table->dropColumn('contato_id');

        });
    }
}
