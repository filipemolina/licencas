<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LimparTabelaEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {

            // Remover os campos que agora fazem parte do relacionamento
            // com as tabelas 'enderecos' e 'pessoas'
            
            $table->dropColumn('telefone');
            $table->dropColumn('fax');
            $table->dropColumn('celular');
            $table->dropColumn('contato');
            $table->dropColumn('email');

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
            
            $table->string('telefone')->after('inscricao_estadual');
            $table->string('fax')->after('telefone');
            $table->string('celular')->after('fax');
            $table->string('contato')->after('celular');
            $table->string('email')->after('contato');

        });
    }
}
